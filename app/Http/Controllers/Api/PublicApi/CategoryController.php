<?php

namespace App\Http\Controllers\Api\PublicApi;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Cache::remember('public.categories', 3600, function () {
            return Category::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->toArray();
        });

        return CategoryResource::collection(Category::hydrate($categories));
    }
}
