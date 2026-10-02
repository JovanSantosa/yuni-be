<?php

namespace App\Observers;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageObserver
{
    public function deleted(ProductImage $image): void
    {
        Storage::disk('public')->delete($image->image_path);
    }
}
