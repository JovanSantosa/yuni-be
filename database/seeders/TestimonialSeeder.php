<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name' => 'Andi Saputra',
                'customer_status' => 'Pelanggan Setia',
                'quote' => 'Sudah langganan dari 2018. Setiap beli HP di Yuni Counter pasti dikasih tau kondisi sejujur-jujurnya. Harga juga paling murah dibanding toko lain di First Square. Recommended banget.',
                'avatar_path' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&q=80',
                'order' => 1,
            ],
            [
                'customer_name' => 'Sinta Dewi',
                'customer_status' => 'Pembeli MacBook',
                'quote' => 'Beli MacBook bekas di sini, dikasih tau semua detailnya -- cycle count, kondisi baterai, goresan kecil. Nggak ada yang ditutupin. Harga juga fair banget. Terima kasih Yuni Counter!',
                'avatar_path' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=150&q=80',
                'order' => 2,
            ],
            [
                'customer_name' => 'Rizki Pratama',
                'customer_status' => 'Pelanggan Tukar Tambah',
                'quote' => 'Tukar tambah HP lama ke baru di sini prosesnya gampang dan cepat. Harga tukar tambah yang dikasih juga masuk akal. Sudah beberapa kali tukar tambah di Yuni Counter.',
                'avatar_path' => 'https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?auto=format&fit=crop&w=150&q=80',
                'order' => 3,
            ],
            [
                'customer_name' => 'Dimas Kurniawan',
                'customer_status' => 'Pelanggan Sejak 2020',
                'quote' => 'Teman-teman di pabrik semuanya beli HP di Yuni Counter. Harganya paling murah se-First Square. Ownernya juga ramah dan nggak pernah maksa beli. Pokoknya top!',
                'avatar_path' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80',
                'order' => 4,
            ],
            [
                'customer_name' => 'Maya Anggraeni',
                'customer_status' => 'Pelanggan Baru',
                'quote' => 'Baru pertama kali ke Taiwan, teman rekomendasikan beli HP di Yuni Counter. Ternyata benar, pelayanannya bagus, harga kompetitif, dan barangnya berkualitas. Sekarang jadi langganan.',
                'avatar_path' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=150&q=80',
                'order' => 5,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['customer_name' => $t['customer_name']],
                $t
            );
        }
    }
}
