<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->get();

        return BannerResource::collection($banners);
    }

    public function store(StoreBannerRequest $request)
    {
        $path = $this->storeBannerImage($request->file('image'));

        $banner = Banner::create([
            ...$request->validated(),
            'image_path' => $path,
        ]);

        return new BannerResource($banner);
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->storeBannerImage($request->file('image'));
        }

        unset($data['image']);
        $banner->update($data);

        return new BannerResource($banner);
    }

    public function destroy(Banner $banner)
    {
        $banner->delete(); // Observer handles file cleanup

        return response()->json(['message' => 'Banner berhasil dihapus.']);
    }

    private function storeBannerImage($file): string
    {
        $filename = uniqid() . '.webp';
        $directory = 'banners';

        Storage::disk('public')->makeDirectory($directory);
        $fullPath = Storage::disk('public')->path("{$directory}/{$filename}");

        $image = Image::decode($file);
        $image->scaleDown(width: 1920);
        $image->save($fullPath, quality: 85);

        return "{$directory}/{$filename}";
    }
}
