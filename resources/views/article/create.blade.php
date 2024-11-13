@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Create a New Article</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Title Input -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" name="title" id="title" class="w-full p-3 border rounded" required>
        </div>

        <!-- Content Input -->
        <div class="mb-4">
            <label for="content" class="block text-gray-700">Content</label>
            <textarea name="content" id="content" rows="5" class="w-full p-3 border rounded" required></textarea>
        </div>

        <!-- Image Upload -->
        <div class="mb-4">
            <label for="images" class="block text-gray-700">Upload Images</label>
            <input type="file" name="images[]" multiple class="w-full p-3 border rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Submit</button>
    </form>
</div>
@endsection
