@extends('layouts.main')

@section('title', 'Product')

@section('content')
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 sm:py-16 lg:max-w-7xl lg:px-8">
            <div class="flex justify-between items-center">
                <h2 class="font-extrabold">Products</h2>
                @if (auth()->check() && auth()->user()->role == "admin")
                    <a href="{{ route('products.create') }}">
                        <button class="text-white bg-red-500 px-4 py-2 rounded-lg hover:bg-red-700">
                            + Add New Product
                        </button>
                    </a>
                @endif
            </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                @foreach ($products as $product)
                    <a href="#" class="no-underline bg-gray-50 hover:bg-gray-200 p-4 rounded-lg">
                        <img src="{{ asset('storage/' . $product->pictures->first()->pictureLink) }}" alt="{{ $product->name }}" class="w-64 h-64 object-cover rounded-lg">
                        <h3 class="mt-4 text-base text-gray-700">{{ $product->name }}</h3>
                        <p class="mt-1 text-base font-bold text-gray-900 mb-2">Rp. {{ $product->price }}</p>
                        @foreach ($product->categories as $category)
                            <p class="text-white text-xs p-1 px-2 bg-red-500 inline-block rounded-lg">{{ $category->name }}</p>
                        @endforeach
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
