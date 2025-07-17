@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Kategori</h1>
        <a href="{{ route('categories.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
            + Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($categories->count())
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3 text-left">Deskripsi</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 text-sm">
                    @foreach ($categories as $category)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $category->name }}</td>
                            <td class="px-6 py-4">{{ $category->description }}</td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('categories.edit', $category->id) }}"
                                   class="text-blue-600 hover:underline text-sm">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="mt-4 text-gray-500">Belum ada kategori ditambahkan.</div>
    @endif
</div>
@endsection
