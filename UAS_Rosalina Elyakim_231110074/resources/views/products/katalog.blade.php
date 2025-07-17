@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <h1 class="text-3xl font-bold mb-8 text-center">📚 Katalog Produk Digital</h1>

    {{-- FLASH MESSAGE --}}
    @foreach (['success' => 'green', 'error' => 'red', 'info' => 'blue'] as $type => $color)
        @if(session($type))
            <div class="bg-{{ $color }}-100 border border-{{ $color }}-400 text-{{ $color }}-700 px-4 py-3 rounded mb-6">
                {{ session($type) }}
            </div>
        @endif
    @endforeach

    {{-- DAFTAR PRODUK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($products as $product)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col">
                {{-- GAMBAR PRODUK --}}
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-auto max-h-[500px] object-contain mx-auto bg-white">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-500">
                        Tidak ada gambar
                    </div>
                @endif

                {{-- INFO PRODUK --}}
                <div class="p-5 flex flex-col flex-1">
                    <h2 class="text-xl font-semibold mb-1">{{ $product->name }}</h2>
                    <p class="text-sm text-gray-500 mb-1">
                        Kategori: <span class="font-medium">{{ $product->category->name ?? '-' }}</span>
                    </p>
                    <p class="text-green-600 font-bold text-lg mb-2">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    {{-- FILE YANG TERSEDIA --}}
                    @if($product->file_pdf || $product->file_path)
                        <p class="text-xs text-gray-500 mb-3">
                            📁 File tersedia:
                            @if($product->file_pdf)
                                PDF
                            @elseif($product->file_path)
                                {{ strtoupper(pathinfo($product->file_path, PATHINFO_EXTENSION)) }}
                            @endif
                        </p>
                    @endif

                    {{-- TOMBOL AKSI --}}
                    <div class="mt-auto">
                        @if(auth()->check() && auth()->user()->purchases->contains('product_id', $product->id))
                            {{-- Sudah dibeli --}}
                            @if($product->file_pdf || $product->file_path)
                                <a href="{{ route('produk.download', $product) }}"
                                   class="block w-full bg-green-500 hover:bg-green-600 text-white text-center py-2 rounded mb-2 text-sm">
                                    📥 Download Produk
                                </a>
                            @endif

                            @if($product->download_link)
                                <a href="{{ $product->download_link }}" target="_blank"
                                   class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded text-sm">
                                    🔗 Link Download
                                </a>
                            @endif
                        @else
                            @auth
                                <form action="{{ route('produk.beli', $product) }}" method="POST" class="w-full">
                                    @csrf
                                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded text-sm">
                                        🛒 Beli Sekarang
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login.user') }}"
                                   class="text-blue-600 hover:text-blue-800 underline text-sm block text-center mt-2">
                                    👤 Login untuk membeli
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Tidak ada produk tersedia saat ini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
