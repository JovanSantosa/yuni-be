<?php

namespace App\Http\Resources;

use App\Models\Setting;
use App\Services\WhatsAppLinkService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $exchangeRate = (float) Setting::get('idr_exchange_rate', 500);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'price_idr' => round($this->price * $exchangeRate),
            'condition' => $this->condition,
            'branch' => $this->branch,
            'stock' => $this->stock,
            'stock_status' => $this->stock_status,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'images' => ProductImageResource::collection($this->whenLoaded('images')),
            'wa_link' => app(WhatsAppLinkService::class)->generate($this->resource),
            'meta_title' => $this->meta_title_resolved,
            'meta_description' => $this->meta_description_resolved,
        ];
    }
}
