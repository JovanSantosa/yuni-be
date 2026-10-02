<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['sometimes', 'exists:categories,id'],
            'name' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['sometimes', 'numeric', 'min:0'],
            'condition' => ['sometimes', 'in:new,used'],
            'stock' => ['sometimes', 'integer', 'min:0'],
            'branch' => ['sometimes', 'in:room330,room281,both'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'wa_message_template' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:60'],
            'meta_description' => ['nullable', 'string', 'max:160'],
        ];
    }
}
