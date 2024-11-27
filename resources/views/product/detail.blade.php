@extends('layouts.main')

@section('title', $product->name)

@section('content')
    <div class="bg-white">
        <div class="pt-6">
            <nav aria-label="Breadcrumb">
            <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                <li>
                <div class="flex items-center">
                    <a href="{{ route('products.index') }}" class="mr-2 text-sm font-medium text-gray-900">Product</a>
                    <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                    </svg>
                </div>
                </li>

                <li class="text-sm">
                <a href="#" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ $product->name }}</a>
                </li>
            </ol>
            </nav>

            <!-- Image gallery -->
            <div class="container">
                <div class="px-8">
                    @if($product->pictures->isNotEmpty())
                        <div id="carouselExample" class="carousel slide mb-6" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @if($product->pictures->isNotEmpty())
                                    @foreach ($product->pictures as $index => $picture)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $picture->pictureLink) }}" alt="{{ $product->title }}" class="d-block w-100 object-cover rounded-lg shadow-md">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <img src="https://via.placeholder.com/800x400?text=No+Images" alt="No images" class="d-block w-100">
                                    </div>
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product info -->
            <div class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
            <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $product->name }}</h1>
            </div>

            <!-- Options -->
            <div class="mt-4 lg:row-span-3 lg:mt-0">
                <h2 class="sr-only">Product information</h2>
                <p class="text-3xl tracking-tight text-gray-900">Rp. {{ $product->price }}</p>

                <form method="POST" class="mt-10" action="/product/add/cart/{{ $product->id }}">
                    @csrf
                    <!-- Quantity -->
                    <div>
                        <h3 id="quantity" class="text-sm font-medium text-gray-900">Quantity</h3>
                        <input type="number" name="quantity" id="quantity" class="w-full p-3 border rounded-lg shadow-sm" placeholder="Enter the product quantity" required value="1">
                    </div>

                    <button type="submit" class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add To Cart</button>
                </form>
            </div>

            <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                <!-- Description and details -->
                <div>
                <h3 class="sr-only">Description</h3>

                <div class="space-y-6">
                    <p class="text-base text-gray-900">The Basic Tee 6-Pack allows you to fully express your vibrant personality with three grayscale options. Feeling adventurous? Put on a heather gray tee. Want to be a trendsetter? Try our exclusive colorway: &quot;Black&quot;. Need to add an extra pop of color to your outfit? Our white tee has you covered.</p>
                </div>
                </div>

                <div class="mt-10">
                <h3 class="text-sm font-medium text-gray-900">Highlights</h3>

                <div class="mt-4">
                    <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                    <li class="text-gray-400"><span class="text-gray-600">Hand cut and sewn locally</span></li>
                    <li class="text-gray-400"><span class="text-gray-600">Dyed with our proprietary colors</span></li>
                    <li class="text-gray-400"><span class="text-gray-600">Pre-washed &amp; pre-shrunk</span></li>
                    <li class="text-gray-400"><span class="text-gray-600">Ultra-soft 100% cotton</span></li>
                    </ul>
                </div>
                </div>

                <div class="mt-10">
                <h2 class="text-sm font-medium text-gray-900">Details</h2>

                <div class="mt-4 space-y-6">
                    <p class="text-sm text-gray-600">The 6-Pack includes two black, two white, and two heather gray Basic Tees. Sign up for our subscription service and be the first to get new, exciting colors, like our upcoming &quot;Charcoal Gray&quot; limited release.</p>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
