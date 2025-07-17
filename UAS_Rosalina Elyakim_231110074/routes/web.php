<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomLoginController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;

// =============================
// Login Terpisah Admin & User
// =============================
Route::get('/login/admin', [CustomLoginController::class, 'showAdminLogin'])->name('login.admin');
Route::get('/login/user', [CustomLoginController::class, 'showUserLogin'])->name('login.user');
Route::post('/login/process', [CustomLoginController::class, 'login'])->name('login.process');
Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');

// =============================
// Route Publik (tanpa login)
// =============================
Route::get('/', [ProductController::class, 'katalog'])->name('home');
Route::get('/katalog', [ProductController::class, 'katalog'])->name('katalog');

// =============================
// Redirect Dashboard
// =============================
Route::get('/dashboard', function () {
    $user = auth()->user();
    return $user && $user->role === 'admin'
        ? redirect()->route('products.index')
        : redirect()->route('katalog');
})->middleware(['auth'])->name('dashboard');

// =============================
// Route yang membutuhkan login
// =============================
Route::middleware(['auth'])->group(function () {

    // Admin only - cek role di controller
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    // User biasa (lihat produk versi user)
    Route::get('/products/user', [ProductController::class, 'userIndex'])->name('products.user');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/beli/{product}', [ProductController::class, 'beli'])->name('produk.beli');
    Route::get('/download/{product}', [ProductController::class, 'download'])->name('produk.download');
});

// Katalog berdasarkan kategori (publik)
Route::get('/katalog/kategori/{slug}', [ProductController::class, 'kategori'])->name('katalog.kategori');

