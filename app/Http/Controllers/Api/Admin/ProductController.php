<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $perPage = min((int) ($request->per_page ?? 15), 50);

        return ProductResource::collection(
            $query->orderByDesc('created_at')->paginate($perPage)
        );
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $this->storeImage($file, $product->id);
                $product->images()->create([
                    'image_path' => $path,
                    'order' => $index,
                ]);
            }
        }

        $product->load(['category', 'images']);

        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        $product->load(['category', 'images']);

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        // Images will be cascade-deleted by DB + observer cleans files
        $product->images->each(fn ($img) => $img->delete());
        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus.']);
    }

    // ── Image Management ──

    public function storeImages(Request $request, Product $product)
    {
        $currentCount = $product->images()->count();
        $maxAllowed = 5 - $currentCount;

        if ($maxAllowed <= 0) {
            return response()->json([
                'message' => 'Maksimal 5 gambar per produk.',
            ], 422);
        }

        $request->validate([
            'images' => ['required', 'array', "max:{$maxAllowed}"],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
        ]);

        $newImages = [];
        foreach ($request->file('images') as $index => $file) {
            $path = $this->storeImage($file, $product->id);
            $newImages[] = $product->images()->create([
                'image_path' => $path,
                'order' => $currentCount + $index,
            ]);
        }

        return response()->json([
            'message' => 'Gambar berhasil diupload.',
            'data' => $newImages,
        ]);
    }

    public function destroyImage(Product $product, ProductImage $image)
    {
        if ($image->product_id !== $product->id) {
            return response()->json(['message' => 'Gambar tidak ditemukan.'], 404);
        }

        $image->delete(); // Observer handles file cleanup

        return response()->json(['message' => 'Gambar berhasil dihapus.']);
    }

    // ── Private Helpers ──

    private function storeImage($file, int $productId): string
    {
        $filename = uniqid() . '.webp';
        $directory = "products/{$productId}";

        Storage::disk('public')->makeDirectory($directory);
        $fullPath = Storage::disk('public')->path("{$directory}/{$filename}");

        $image = Image::decode($file);
        $image->scaleDown(width: 1200);
        $image->save($fullPath, quality: 80);

        return "{$directory}/{$filename}";
    }
}
