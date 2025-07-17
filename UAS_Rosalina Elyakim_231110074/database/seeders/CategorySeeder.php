<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Ebook',
            'description' => 'Koleksi buku digital',
        ]);

        Category::create([
            'name' => 'Template',
            'description' => 'Template desain dan dokumen',
        ]);

        Category::create([
            'name' => 'Aplikasi',
            'description' => 'Produk software siap pakai',
        ]);
    }
}
