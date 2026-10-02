<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Handphone', 'icon' => 'smartphone', 'order' => 1],
            ['name' => 'Laptop & MacBook', 'icon' => 'laptop', 'order' => 2],
            ['name' => 'iPad & Tablet', 'icon' => 'tablet', 'order' => 3],
            ['name' => 'Aksesoris', 'icon' => 'headphones', 'order' => 4],
            ['name' => 'Tukar Tambah', 'icon' => 'repeat', 'order' => 5],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
