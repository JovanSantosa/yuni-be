<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Setting;

class WhatsAppLinkService
{
    public function generate(Product $product): string
    {
        $number = Setting::get('whatsapp_number', '');

        $template = $product->wa_message_template
            ?: Setting::get('whatsapp_default_message', 'Halo, saya tertarik dengan {product_name}');

        $message = str_replace('{product_name}', $product->name, $template);

        return "https://wa.me/{$number}?text=" . urlencode($message);
    }
}
