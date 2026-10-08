<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $hp = Category::where('slug', 'handphone')->first();
        $laptop = Category::where('slug', 'laptop-macbook')->first();
        $tablet = Category::where('slug', 'ipad-tablet')->first();
        $acc = Category::where('slug', 'aksesoris')->first();

        $products = [
            [
                'category_id' => $hp?->id,
                'name' => 'iPhone 15 Pro Max 256GB Natural Titanium',
                'description' => 'Battery health 93%, kelengkapan fullset original box, bebas reset, fungsi face ID & kamera normal 100%.',
                'price' => 28500,
                'condition' => 'used',
                'stock' => 5,
                'is_featured' => true,
                'branch' => 'room330',
                'image' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'category_id' => $hp?->id,
                'name' => 'iPhone 14 128GB Midnight Black',
                'description' => 'Fisik 96% mulus terawat, baterai 88%, icloud aman siap pakai, garansi toko 1 bulan.',
                'price' => 15800,
                'condition' => 'used',
                'stock' => 3,
                'is_featured' => false,
                'branch' => 'room281',
                'image' => 'https://images.unsplash.com/photo-1510557880182-3d4d3cba35a5?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'category_id' => $hp?->id,
                'name' => 'Samsung Galaxy S24 Ultra 5G 512GB Titanium Gray',
                'description' => 'BNIB Segel resmi, garansi resmi Taiwan 1 tahun, Snapdragon 8 Gen 3 for Galaxy, S-Pen included.',
                'price' => 33500,
                'condition' => 'new',
                'stock' => 4,
                'is_featured' => true,
                'branch' => 'room330',
                'image' => 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'category_id' => $hp?->id,
                'name' => 'Samsung Galaxy A55 5G 256GB Awesome Navy',
                'description' => 'Smartphone mid-range paling worth it, layar Super AMOLED 120Hz, kamera OIS jernih, tahan air IP67.',
                'price' => 10900,
                'condition' => 'new',
                'stock' => 7,
                'is_featured' => false,
                'branch' => 'room281',
                'image' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'category_id' => $hp?->id,
                'name' => 'Xiaomi 14 12GB/512GB Leica Camera White',
                'description' => 'Kamera lensa Leica mantap, chipset Snapdragon 8 Gen 3, body compact premium, fullset original.',
                'price' => 18200,
                'condition' => 'used',
                'stock' => 2,
                'is_featured' => false,
                'branch' => 'room330',
                'image' => 'https://images.unsplash.com/photo-1565849904461-04a58ad377e0?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'category_id' => $laptop?->id,
                'name' => 'MacBook Air M2 13.6-inch 8GB/256GB Space Gray',
                'description' => 'Cycle count baterai rendah hanya 48x, battery health 99%, keyboard US layout, charger MagSafe original.',
                'price' => 23900,
                'condition' => 'used',
                'stock' => 3,
                'is_featured' => true,
                'branch' => 'room330',
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'category_id' => $laptop?->id,
                'name' => 'MacBook Pro 14-inch M3 Pro 18GB/512GB Space Black',
                'description' => 'Warna langka Space Black, layar Liquid Retina XDR 120Hz, performa rendering & editing sangat kencang.',
                'price' => 52000,
                'condition' => 'used',
                'stock' => 2,
                'is_featured' => true,
                'branch' => 'room330',
                'image' => 'https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'category_id' => $laptop?->id,
                'name' => 'ASUS Vivobook 15 Core i5 16GB/512GB SSD Silver',
                'description' => 'Laptop kerja & kuliah kencang, Windows 11 Home lisensi original, layar 15.6 inci Full HD anti-glare.',
                'price' => 18500,
                'condition' => 'new',
                'stock' => 5,
                'is_featured' => false,
                'branch' => 'room281',
                'image' => 'https://images.unsplash.com/photo-1531297484001-80022131f5a1?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'category_id' => $tablet?->id,
                'name' => 'iPad Air 5 M1 64GB WiFi Starlight',
                'description' => 'Chipset kencang Apple M1, support Apple Pencil 2 & Magic Keyboard, layar 10.9 Liquid Retina, body mulus.',
                'price' => 13900,
                'condition' => 'used',
                'stock' => 4,
                'is_featured' => true,
                'branch' => 'room330',
                'image' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'category_id' => $tablet?->id,
                'name' => 'iPad 10th Gen 64GB WiFi Blue',
                'description' => 'Desain bezel tipis all-screen modern, USB-C port, kamera depan landscape Ultra-Wide dengan Center Stage.',
                'price' => 11200,
                'condition' => 'new',
                'stock' => 6,
                'is_featured' => false,
                'branch' => 'room281',
                'image' => 'https://images.unsplash.com/photo-1561154464-82e9adf32764?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'category_id' => $acc?->id,
                'name' => 'Apple AirPods Pro Gen 2 USB-C MagSafe Case',
                'description' => 'Active Noise Cancellation 2x lebih senyap, chip H2 bertenaga, port USB-C, garansi resmi Apple 1 tahun.',
                'price' => 6490,
                'condition' => 'new',
                'stock' => 10,
                'is_featured' => true,
                'branch' => 'room330',
                'image' => 'https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?auto=format&fit=crop&w=700&q=80',
            ],
            [
                'category_id' => $acc?->id,
                'name' => 'Anker MagGo Powerbank 10.000mAh Qi2 Fast Charge',
                'description' => 'Support magnetic wireless 15W Qi2 resmi untuk iPhone 12/13/14/15, ada display baterai LED pintar.',
                'price' => 1650,
                'condition' => 'new',
                'stock' => 8,
                'is_featured' => false,
                'branch' => 'both',
                'image' => 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?auto=format&fit=crop&w=700&q=80',
            ],
        ];

        foreach ($products as $item) {
            $imageUrl = $item['image'];
            unset($item['image']);

            $product = Product::updateOrCreate(
                ['name' => $item['name']],
                $item
            );

            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'order' => 0],
                ['image_path' => $imageUrl]
            );
        }
    }
}
