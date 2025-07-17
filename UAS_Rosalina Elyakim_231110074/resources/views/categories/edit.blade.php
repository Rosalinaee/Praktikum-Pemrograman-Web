@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Edit Kategori</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-gray-700 font-medium">Nama Kategori</label>
            <input type="text" name="name" class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"
                   value="{{ old('name', $category->name) }}" required>
        </div>

        <div>
            <label for="description" class="block text-gray-700 font-medium">Deskripsi</label>
            <textarea name="description" rows="4"
                      class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                Update
            </button>
            <a href="{{ route('categories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
