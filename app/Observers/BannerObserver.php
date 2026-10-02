<?php

namespace App\Observers;

use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerObserver
{
    public function updating(Banner $banner): void
    {
        if ($banner->isDirty('image_path')) {
            Storage::disk('public')->delete($banner->getOriginal('image_path'));
        }
    }

    public function deleted(Banner $banner): void
    {
        Storage::disk('public')->delete($banner->image_path);
    }
}
