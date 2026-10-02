<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            SettingSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
