@extends('layouts.main')

@section('title', 'Forum')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex flex-row justify-between items-start mb-6">
        <form method="GET" action="{{ route('articles.index') }}" class="w-full flex flex-col items-start gap-4">
            <div class="w-full flex justify-center items-center">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search forum by title..." class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
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
                    Select Forum
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

        @if(auth()->check())
        <a href="{{ route('forums.new.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded ml-4 no-underline whitespace-nowrap">
            + Create Forum
        </a>
        @endif
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
