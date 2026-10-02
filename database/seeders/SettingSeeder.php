<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'hero_title' => json_encode([
                'id' => 'Konter HP Terpercaya di Taichung',
                'zh-TW' => '台中最值得信賴的手機專賣店',
                'en' => 'Trusted Phone Store in Taichung',
            ], JSON_UNESCAPED_UNICODE),

            'hero_subtitle' => json_encode([
                'id' => 'Jual beli HP, laptop, MacBook, iPad, tablet, dan aksesoris baru & bekas. Harga termurah dengan kualitas terbaik. Kami tidak pernah berbohong mengenai kondisi barang -- semua disampaikan apa adanya.',
                'zh-TW' => '全新與優質二手 iPhone、Samsung、MacBook、iPad 及配件買賣。堅持誠信透明、絕不隱瞞機況，以最實惠的價格提供最頂級的品質。',
                'en' => 'Buy and sell new & used smartphones, MacBooks, iPads, and accessories. Best prices with top quality. 100% honest and transparent about device condition.',
            ], JSON_UNESCAPED_UNICODE),

            'about_text' => json_encode([
                'id' => "Yuni Counter telah melayani kebutuhan handphone dan gadget di Taichung, Taiwan sejak tahun 2004. Berlokasi di First Square (Asean Square Pyramid) Lantai 3, kami telah menjadi pilihan utama bagi komunitas Indonesia dan Asia Tenggara di Taiwan.\n\nYang membedakan kami adalah kejujuran. Setiap produk yang kami jual, baik baru maupun bekas, selalu kami informasikan kondisinya secara transparan. Tidak ada yang ditutup-tutupi. Kepercayaan pelanggan adalah aset terbesar kami.",
                'zh-TW' => "Yuni Counter 自 2004 年起在台灣台中第一廣場（東協廣場金字塔）三樓服務廣大顧客。多年來已成為台中當地居民與東南亞國際朋友的首選手機專賣店。\n\n我們與眾不同的核心價值是「誠信透明」。每台售出的全新或二手手機，我們都會毫無隱瞞地說明真實機況。顧客的長久信任是我們最珍貴的資產。",
                'en' => "Yuni Counter has been serving smartphones and tech gadgets in Taichung, Taiwan since 2004. Located at First Square (Asean Square Pyramid) 3rd Floor, we have become the trusted choice for the local community and international residents.\n\nWhat sets us apart is 100% honesty. We transparently disclose the true condition of every device. Customer trust is our greatest asset.",
            ], JSON_UNESCAPED_UNICODE),

            'hero_image' => 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?auto=format&fit=crop&w=1000&q=80',
            'about_image' => 'https://images.unsplash.com/photo-1556742049-0a67c5574f73?auto=format&fit=crop&w=1200&q=80',
            'cta_image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=1600&q=80',

            'address_room330' => 'First Square, Lantai 3, Room 330, Taichung, Taiwan',
            'address_room281' => 'First Square, Lantai 3, Room 281, Taichung, Taiwan',
            'phone_number' => '0987-872-888',
            'whatsapp_number' => '886987872888',
            'whatsapp_default_message' => 'Halo Yuni Counter, saya tertarik dengan {product_name}',
            'tiktok_account_1' => 'https://www.tiktok.com/@yunistore.lt3room330',
            'tiktok_account_2' => 'https://www.tiktok.com/@yuni.counter.3f',
            'operating_hours' => "Buka Setiap Hari\n10:00 - 21:00",
            'map_url' => 'https://share.google/oFDeRwP7eAVEDpr5u',
            'stat_customers' => '1000+',
            'stat_years' => '20+',
            'stat_branches' => '2',
            'low_stock_threshold' => '3',
            'idr_exchange_rate' => '500',
            
            'meta_title' => json_encode([
                'id' => 'Yuni Counter - Konter HP Terpercaya di Taichung, Taiwan',
                'zh-TW' => 'Yuni Counter - 台中第一廣場誠信手機專賣店',
                'en' => 'Yuni Counter - Trusted Phone Shop in Taichung, Taiwan',
            ], JSON_UNESCAPED_UNICODE),

            'meta_description' => json_encode([
                'id' => 'Jual beli HP, laptop, MacBook, iPad, tablet, dan aksesoris baru & bekas. Harga jujur, stok update. Sejak 2004 di First Square Taichung.',
                'zh-TW' => '買賣全新及二手手機、MacBook、iPad及配件。價格公道、現貨充足。自2004年起在地服務。',
                'en' => 'Buy & sell new and used phones, MacBooks, iPads, and accessories in Taichung since 2004.',
            ], JSON_UNESCAPED_UNICODE),
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
