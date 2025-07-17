@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="name" value="{{ $product->name }}"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div>
            <label for="description" class="block font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" rows="4"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">{{ $product->description }}</textarea>
        </div>

        <div>
            <label for="category_id" class="block font-medium text-gray-700">Kategori</label>
            <select name="category_id" id="categorySelect" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="price" class="block font-medium text-gray-700">Harga</label>
            <input type="number" name="price" value="{{ $product->price }}"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div>
            <label for="download_link" class="block font-medium text-gray-700">Link Download (Opsional)</label>
            <input type="url" name="download_link" value="{{ $product->download_link }}"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
        </div>

        {{-- Upload file baru --}}
        <div>
            <label for="upload_file" class="block font-medium text-gray-700">Upload File Produk Digital</label>
            <input type="file" name="upload_file" class="mt-1 w-full" accept=".pdf,.zip,.rar,.docx,.xlsx,.pptx,.jpg,.jpeg,.png">

            @if ($product->file_pdf)
                <p class="text-sm text-gray-600 mt-1">File eBook saat ini: {{ basename($product->file_pdf) }}</p>
            @elseif ($product->file_path)
                <p class="text-sm text-gray-600 mt-1">File saat ini: {{ basename($product->file_path) }}</p>
            @endif
        </div>

        <div>
            <label for="status" class="block font-medium text-gray-700">Status</label>
            <select name="status"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
                <option value="aktif" {{ $product->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $product->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <div>
            <label for="image" class="block font-medium text-gray-700">Gambar Produk</label>
            <input type="file" name="image" accept="image/*" class="mt-1">
            @if($product->image)
                <p class="text-sm text-gray-500 mt-1">Gambar saat ini:
                    <img src="{{ asset('storage/' . $product->image) }}" alt="gambar" class="h-16 inline-block">
                </p>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Update</button>
            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">Batal</a>
        </div>
    </form>
</div>
@endsection
