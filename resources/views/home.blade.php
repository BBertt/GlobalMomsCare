@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <form method="GET" action="{{ route('articles.index') }}" class="w-full md:w-1/2">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search articles by title..."
                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500"
            >
        </form>
        @if(auth()->check() && auth()->user()->role === 'professional')
        <a href="{{ route('articles.new.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded ml-4">
            + Create Article
        </a>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($articles as $article)
        <div class="card bg-white shadow-lg rounded-lg overflow-hidden flex flex-col">
            @php

            @endphp
            @if ($article->pictures->isNotEmpty())
                <img src="{{ asset('storage/' . $article->pictures->first()->pictureLink) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
            @else
                <img src="{{ asset('images/default.jpg') }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
            @endif
            <div class="flex flex-col justify-between flex-1 p-6">
                <div>
                    <h5 class="text-xl font-bold text-red-600 mb-4">{{ Str::words($article->title, 5) }}</h5>
                    <p class="text-gray-700 mb-6">{{ Str::words($article->content, 20) }}</p>
                </div>
                <a href="{{ route('articles.show', $article->id) }}" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded transition duration-300 self-start inline-block" style="text-decoration: none;">
                    Learn More
                </a>
            </div>
        </div>
        @empty
        <p class="text-gray-500">No articles found.</p>
        @endforelse
    </div>
</div>
@endsection
