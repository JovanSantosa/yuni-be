<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BannerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image_url' => Storage::disk('public')->url($this->image_path),
            'link_url' => $this->link_url,
            'order' => $this->order,
            'is_active' => $this->is_active,
        ];
    }
}
