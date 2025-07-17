@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Katalog Produk (User)</h1>

        <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($products as $product)
                <li class="border p-4 rounded shadow">
                    <h2 class="font-semibold">{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
