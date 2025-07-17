@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Header dan Navigasi --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Katalog Produk</h1>
        @auth
        <div class="space-x-2 bg-red-100 p-2 rounded">
            <a href="{{ route('products.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                + Tambah Produk
            </a>
            <a href="{{ route('categories.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded">
                Kategori
            </a>
        </div>
        @endauth
    </div>

    {{-- Daftar Produk --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($products as $product)
            {{-- Card Produk --}}
            <div class="bg-white rounded-lg shadow p-4">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-48 object-cover rounded-t-md">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 rounded-t-md">
                        Tidak ada gambar
                    </div>
                @endif

                <h2 class="text-lg font-semibold mt-2">{{ $product->name }}</h2>
                <p class="text-sm text-gray-600">Kategori: {{ $product->category->name }}</p>
                <p class="text-sm">{{ $product->description }}</p>
                <p class="text-green-600 font-bold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="text-sm">Status: {{ ucfirst($product->status) }}</p>

                <div class="flex justify-between items-center mt-4">
                    <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada produk.</p>
        @endforelse
    </div>
</div>
@endsection
