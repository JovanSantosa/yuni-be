<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $path = $this->image_path;
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            $url = $path;
        } else {
            $url = Storage::disk('public')->url($path);
        }

        return [
            'id' => $this->id,
            'url' => $url,
            'order' => $this->order,
        ];
    }
}
