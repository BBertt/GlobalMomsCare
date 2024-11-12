@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="container mx-auto p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($articles as $article)
        <!-- Card -->
        <div class="card bg-white shadow-lg rounded-lg overflow-hidden flex flex-col">
            <img src="{{ asset('images/default.jpg') }}" alt="{{ asset('images/default.jpg') }}" class="w-full h-48 object-cover">
            <div class="flex flex-col justify-between flex-1 p-6">
                <div>
                    <h5 class="text-xl font-bold text-red-600 mb-4">{{ Str::words($article->title, 5) }}</h5>
                    <p class="text-gray-700 mb-6">{{ Str::words($article->content, 20) }}</p>
                </div>
                <!-- Button with fixed width -->
                <a href="#" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded transition duration-300 self-start inline-block" style="text-decoration: none;">
                    Learn More
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
