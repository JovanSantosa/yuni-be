<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => json_encode([
                    'id' => 'Apakah Yuni Counter menjual HP baru atau bekas?',
                    'zh-TW' => 'Yuni Counter 販售的是全新機還是二手手機？',
                    'en' => 'Does Yuni Counter sell brand new or second-hand phones?',
                ], JSON_UNESCAPED_UNICODE),
                'answer' => json_encode([
                    'id' => 'Kami menjual keduanya -- HP baru dan bekas. Setiap produk yang kami jual selalu kami informasikan kondisinya secara jujur dan detail. Untuk HP bekas, kami jelaskan kondisi fisik, kesehatan baterai, dan riwayat pemakaian secara transparan.',
                    'zh-TW' => '我們全新機與優質二手手機皆有販售！每款上架商品我們都會誠實公開詳細機況。二手手機會完整說明外觀成色、電池健康度及使用紀錄，絕不隱瞞。',
                    'en' => 'We sell both brand new and certified used devices. For pre-owned phones, we transparently explain the physical condition, battery health, and history.',
                ], JSON_UNESCAPED_UNICODE),
                'order' => 1,
            ],
            [
                'question' => json_encode([
                    'id' => 'Apakah bisa tukar tambah HP lama?',
                    'zh-TW' => '可以帶舊手機來門市辦理「舊機折抵換新機」嗎？',
                    'en' => 'Can I trade in my old phone for a new one?',
                ], JSON_UNESCAPED_UNICODE),
                'answer' => json_encode([
                    'id' => 'Tentu! Kami menerima tukar tambah untuk HP, laptop, tablet, dan gadget lainnya. Bawa saja perangkat lama Anda ke toko, kami akan cek kondisinya dan berikan penawaran harga terbaik untuk tukar tambah ke perangkat baru.',
                    'zh-TW' => '當然可以！我們提供手機、筆電、平板的舊機回收折抵服務。歡迎直接帶您的舊機至門市，我們將現場檢測並提供最高估價方案！',
                    'en' => 'Absolutely! We accept trade-ins for phones, laptops, and tablets with the best appraisal value.',
                ], JSON_UNESCAPED_UNICODE),
                'order' => 2,
            ],
            [
                'question' => json_encode([
                    'id' => 'Selain HP, produk apa saja yang dijual?',
                    'zh-TW' => '除了智慧型手機，店內還有販售哪些商品？',
                    'en' => 'Besides smartphones, what other products do you sell?',
                ], JSON_UNESCAPED_UNICODE),
                'answer' => json_encode([
                    'id' => 'Selain handphone, kami juga menjual laptop, MacBook, iPad, tablet, dan berbagai aksesoris seperti casing, tempered glass, pelindung kamera, powerbank, earphone, headset, dan perlengkapan gadget lainnya.',
                    'zh-TW' => '除了手機，我們還販售 MacBook、各廠牌筆記型電腦、iPad、平板電腦，以及豐富的手機殼、鋼化保護貼、鏡頭貼、行動電源、耳機等周邊配件。',
                    'en' => 'We also offer MacBooks, Windows laptops, iPads, tablets, and mobile accessories like cases, screen protectors, and powerbanks.',
                ], JSON_UNESCAPED_UNICODE),
                'order' => 3,
            ],
            [
                'question' => json_encode([
                    'id' => 'Di mana lokasi Yuni Counter?',
                    'zh-TW' => 'Yuni Counter 的門市地址在哪裡？',
                    'en' => 'Where is Yuni Counter located?',
                ], JSON_UNESCAPED_UNICODE),
                'answer' => json_encode([
                    'id' => 'Kami berlokasi di First Square (Asean Square Pyramid), Lantai 3, Taichung, Taiwan. Kami memiliki dua toko: Room 281 (cabang utama, sejak 2004) dan Room 330 (cabang baru, sejak 2024). Keduanya berada di lantai yang sama.',
                    'zh-TW' => '我們的門市位於台灣台中第一廣場（東協廣場金字塔）3 樓。我們在同樓層擁有兩間門市：281 室（創立於2004年）與 330 室（2024年擴大新店）。',
                    'en' => 'We are located at First Square (Asean Square Pyramid), 3rd Floor, Taichung, Taiwan. We have two shops: Room 281 and Room 330.',
                ], JSON_UNESCAPED_UNICODE),
                'order' => 4,
            ],
            [
                'question' => json_encode([
                    'id' => 'Bagaimana cara menghubungi Yuni Counter?',
                    'zh-TW' => '如何與 Yuni Counter 客服取得聯繫？',
                    'en' => 'How can I contact Yuni Counter?',
                ], JSON_UNESCAPED_UNICODE),
                'answer' => json_encode([
                    'id' => 'Anda bisa menghubungi kami via WhatsApp di nomor +886 987-872-888 atau telepon langsung ke 0987-872-888. Anda juga bisa langsung datang ke toko kami di First Square Lantai 3, Room 281 atau Room 330, setiap hari dari jam 10 pagi sampai 9 malam.',
                    'zh-TW' => '歡迎隨時透過 WhatsApp (+886 987-872-888) 或撥打電話 0987-872-888 諮詢。也可於每日 10:00 - 21:00 營業時間直接造訪門市。',
                    'en' => 'You can message us on WhatsApp (+886 987-872-888) or call 0987-872-888. You can also visit our store daily from 10:00 AM to 9:00 PM.',
                ], JSON_UNESCAPED_UNICODE),
                'order' => 5,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['order' => $faq['order']],
                $faq
            );
        }
    }
}
