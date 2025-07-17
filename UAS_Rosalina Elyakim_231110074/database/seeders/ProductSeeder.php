<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Laravel Ebook',
            'description' => 'Panduan lengkap Laravel untuk pemula',
            'category_id' => 1,
            'price' => 50000,
            'download_link' => 'https://example.com/download/laravel-ebook',
            'status' => 'aktif'
        ]);

        Product::create([
            'name' => 'Invoice Template',
            'description' => 'Template invoice siap pakai',
            'category_id' => 2,
            'price' => 25000,
            'download_link' => 'https://example.com/download/invoice-template',
            'status' => 'aktif'
        ]);
    }
}
