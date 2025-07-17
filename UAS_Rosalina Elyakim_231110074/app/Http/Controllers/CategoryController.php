<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Tampilkan daftar semua kategori.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Tampilkan form untuk menambahkan kategori baru.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Simpan data kategori baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->withSuccess('Kategori berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit kategori.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Perbarui data kategori di database.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->withSuccess('Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori dari database.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->withSuccess('Kategori berhasil dihapus.');
    }

    /**
     * Tampilkan katalog produk dengan filter kategori
     */
    public function katalog(Request $request)
    {
        // Ambil parameter kategori dari URL
        $kategori = $request->get('kategori');
        
        // Ambil semua kategori untuk menu
        $categories = Category::all();
        
        // Buat query dasar untuk produk
        $products = Product::with('category');
        
        // Filter berdasarkan kategori jika ada
        if ($kategori) {
            $products = $products->whereHas('category', function($query) use ($kategori) {
                $query->where('name', $kategori);
            });
        }
        
        // Ambil hasil
        $products = $products->get();
        
        // Debug info
        $debug_info = [
            'kategori_parameter' => $kategori,
            'total_categories' => $categories->count(),
            'total_products' => $products->count(),
            'all_categories' => $categories->pluck('name')->toArray(),
            'products_with_category' => $products->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'category' => $product->category ? $product->category->name : 'No Category'
                ];
            })->toArray()
        ];
        
        return view('katalog', compact('products', 'categories', 'kategori', 'debug_info'));
    }
}