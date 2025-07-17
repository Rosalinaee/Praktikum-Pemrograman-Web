<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak: khusus admin.');
        }

        $products = Product::with('category')->latest()->paginate(9);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak: khusus admin.');
        }

        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak: khusus admin.');
        }

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'download_link' => 'nullable|url',
            'status' => 'required|in:aktif,nonaktif',
            'image' => 'nullable|image|max:2048',
            'upload_file' => 'nullable|file|max:51200|mimes:pdf,jpg,jpeg,png,zip,rar,docx,xlsx,pptx',
        ]);

        $validated['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        // Handle file upload
        if ($request->hasFile('upload_file')) {
            $category = Category::find($validated['category_id']);
            $categoryName = strtolower($category->name);
            
            // Cek apakah ini kategori ebook
            $isEbook = $categoryName === 'ebook' || str_contains($categoryName, 'ebook');
            
            if ($isEbook) {
                // Untuk ebook, simpan di folder ebooks dan gunakan field file_pdf
                $validated['file_pdf'] = $request->file('upload_file')->store('ebooks', 'public');
            } else {
                // Untuk kategori lain, simpan di folder files dan gunakan field file_path
                $validated['file_path'] = $request->file('upload_file')->store('files', 'public');
            }
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

 public function update(Request $request, Product $product)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak: khusus admin.');
        }

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'download_link' => 'nullable|url',
            'status' => 'required|in:aktif,nonaktif',
            'image' => 'nullable|image|max:2048',
            'upload_file' => 'nullable|file|max:51200|mimes:pdf,jpg,jpeg,png,zip,rar,docx,xlsx,pptx',
        ]);

        $validated['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        // Handle file upload
        if ($request->hasFile('upload_file')) {
            $category = Category::find($validated['category_id']);
            $categoryName = strtolower($category->name);
            
            // Cek apakah ini kategori ebook
            $isEbook = $categoryName === 'ebook' || str_contains($categoryName, 'ebook');
            
            if ($isEbook) {
                // Hapus file PDF lama jika ada
                if ($product->file_pdf && Storage::disk('public')->exists($product->file_pdf)) {
                    Storage::disk('public')->delete($product->file_pdf);
                }
                
                // Simpan file PDF baru
                $validated['file_pdf'] = $request->file('upload_file')->store('ebooks', 'public');
                
                // Reset file_path jika sebelumnya ada
                $validated['file_path'] = null;
            } else {
                // Hapus file lama jika ada
                if ($product->file_path && Storage::disk('public')->exists($product->file_path)) {
                    Storage::disk('public')->delete($product->file_path);
                }
                
                // Simpan file baru
                $validated['file_path'] = $request->file('upload_file')->store('files', 'public');
                
                // Reset file_pdf jika sebelumnya ada
                $validated['file_pdf'] = null;
            }
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }
       
    public function edit(Product $product)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak: khusus admin.');
        }

        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }
    public function destroy(Product $product)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak: khusus admin.');
        }

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        if ($product->file_pdf && Storage::disk('public')->exists($product->file_pdf)) {
            Storage::disk('public')->delete($product->file_pdf);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function userIndex()
    {
        $products = Product::with('category')
            ->where('status', 'aktif')
            ->get();

        return view('products.user_index', compact('products'));
    }

    public function katalog()
    {
        $products = Product::with('category')
            ->where('status', 'aktif')
            ->get();

        return view('products.katalog', compact('products'));
    }

    public function beli(Product $product)
    {
        if (auth()->user()->purchases()->where('product_id', $product->id)->exists()) {
            return back()->with('info', 'Kamu sudah membeli produk ini.');
        }

        Purchase::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id
        ]);

        return back()->with('success', 'Pembelian berhasil!');
    }

public function download(Product $product)
{
    $user = auth()->user();

    // Cek pembelian
    if (!$user->purchases->contains('product_id', $product->id)) {
        abort(403, 'Anda belum membeli produk ini.');
    }

    // Tentukan file path berdasarkan data yang tersimpan
    $filePath = null;
    $fileName = null;
    $originalFileName = null;
    
    if ($product->file_pdf) {
        // Untuk ebook (file PDF)
        $filePath = storage_path('app/public/' . $product->file_pdf);
        $originalFileName = basename($product->file_pdf);
        $fileName = $product->slug . '.pdf';
    } elseif ($product->file_path) {
        // Untuk file lain (ZIP, RAR, DOCX, dll)
        $filePath = storage_path('app/public/' . $product->file_path);
        $originalFileName = basename($product->file_path);
        $extension = pathinfo($product->file_path, PATHINFO_EXTENSION);
        $fileName = $product->slug . '.' . $extension;
    }

    // Debug: Log untuk membantu troubleshooting
    \Log::info('Percobaan download:', [
        'product_id' => $product->id,
        'nama_produk' => $product->name,
        'file_pdf' => $product->file_pdf,
        'file_path' => $product->file_path,
        'path_yang_dihitung' => $filePath,
        'file_ada' => $filePath ? file_exists($filePath) : false,
        'storage_path' => storage_path('app/public/'),
        'nama_file_asli' => $originalFileName
    ]);

    // Jika tidak ada file path atau file tidak ditemukan
    if (!$filePath) {
        abort(404, 'File tidak tersedia untuk produk ini.');
    }

    if (!file_exists($filePath)) {
        // Coba cek apakah file ada di lokasi alternatif
        $alternativePath = public_path('storage/' . ($product->file_pdf ?: $product->file_path));
        
        if (file_exists($alternativePath)) {
            $filePath = $alternativePath;
        } else {
            // Log error untuk debugging
            \Log::error('File tidak ditemukan:', [
                'product_id' => $product->id,
                'path_yang_diharapkan' => $filePath,
                'path_alternatif' => $alternativePath,
                'file_pdf' => $product->file_pdf,
                'file_path' => $product->file_path
            ]);
            
            abort(404, 'File tidak ditemukan di server. Silakan hubungi admin.');
        }
    }

    // Pastikan file dapat dibaca
    if (!is_readable($filePath)) {
        abort(403, 'File tidak dapat dibaca. Silakan hubungi admin.');
    }

    return response()->download($filePath, $fileName);
}



}
