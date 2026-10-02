<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $lowThreshold = (int) Setting::get('low_stock_threshold', 3);

        return response()->json([
            'data' => [
                'total_products' => Product::count(),
                'total_categories' => Category::count(),
                'out_of_stock' => Product::where('stock', '<=', 0)->count(),
                'low_stock' => Product::where('stock', '>', 0)->where('stock', '<=', $lowThreshold)->count(),
                'featured_products' => Product::where('is_featured', true)->count(),
            ],
        ]);
    }
}
