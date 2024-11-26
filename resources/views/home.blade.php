@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex flex-row justify-between items-start mb-6">
        <form method="GET" action="{{ route('articles.index') }}" class="w-full flex flex-col items-start gap-4">
            <div class="w-full flex justify-center items-center">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles by title..." class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
                <div class="ml-8">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                        Search
                    </button>
                </div>
            </div>

            <div class="w-full relative">
                <button
                    type="button"
                    id="dropdownToggle"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500 text-left"
                >
                    Select Categories
                    <span class="float-right">▼</span>
                </button>

                <!-- Dropdown Menu -->
                <div
                    id="dropdownMenu"
                    class="absolute mt-2 w-full bg-white border border-gray-300 rounded shadow-lg hidden z-10"
                >
                    <div class="max-h-60 overflow-y-auto p-2">
                        @foreach($categories as $category)
                        <label class="flex items-center space-x-2 mb-2">
                            <input
                                type="checkbox"
                                id="category{{ $category->id }}"
                                name="categories[]"
                                value="{{ $category->id }}"
                                {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                class="form-checkbox h-4 w-4 text-blue-500"
                            >
                            <span>{{ $category->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

        </form>

        @if(auth()->check() && auth()->user()->role === 'professional')
        <a href="{{ route('articles.new.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded ml-4 no-underline whitespace-nowrap">
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
                    <p class="text-gray-700 mb-4">{{ Str::words($article->content, 20) }}</p>
                </div>
                <div class="flex flex-wrap justify-start items-center mb-2 gap-2">
                    @foreach ($article->categories as $category)
                        <p class="text-white text-xs p-1 px-2 bg-red-500 inline-block rounded-lg">{{ $category->name }}</p>
                    @endforeach
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggle = document.getElementById('dropdownToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownToggle.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
        });
        document.addEventListener('click', function (e) {
            if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    });
</script>
@endsection
