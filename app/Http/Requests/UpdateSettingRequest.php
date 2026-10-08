<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hero_title' => ['nullable'],
            'hero_subtitle' => ['nullable'],
            'hero_image' => ['nullable', 'string', 'max:500'],
            'about_text' => ['nullable'],
            'about_image' => ['nullable', 'string', 'max:500'],
            'cta_image' => ['nullable', 'string', 'max:500'],
            'address_room330' => ['nullable', 'string', 'max:500'],
            'address_room281' => ['nullable', 'string', 'max:500'],
            'phone_number' => ['nullable', 'string', 'max:50'],
            'whatsapp_number' => ['required', 'string'],
            'whatsapp_default_message' => ['nullable', 'string', 'max:255'],
            'whatsapp_hero_message' => ['nullable'],
            'tiktok_account_1' => ['nullable', 'string', 'max:500'],
            'tiktok_account_2' => ['nullable', 'string', 'max:500'],
            'operating_hours' => ['nullable', 'string', 'max:500'],
            'map_url' => ['nullable', 'string', 'max:500'],
            'stat_customers' => ['nullable', 'string', 'max:50'],
            'stat_years' => ['nullable', 'string', 'max:50'],
            'stat_branches' => ['nullable', 'string', 'max:50'],
            'low_stock_threshold' => ['nullable', 'integer', 'min:1'],
            'idr_exchange_rate' => ['nullable', 'numeric', 'min:0'],
            'meta_title' => ['nullable'],
            'meta_description' => ['nullable'],
        ];
    }
}
