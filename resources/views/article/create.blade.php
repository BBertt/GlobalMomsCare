@extends('layouts.main')

@section('title', 'Create Article')

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

        <!-- Category Selection -->
        <div class="mb-4">
            <label for="categories" class="block text-gray-700">Select Categories</label>
            <div class="flex flex-wrap">
                @foreach($categories as $category)
                    <div class="mr-4 mb-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-checkbox text-blue-500">
                            <span class="ml-2">{{ $category->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Image Upload -->
        <div class="mb-4">
            <label for="images" class="block text-gray-700">Upload Images</label>
            <input type="file" id="imageInput" name="images[]" multiple class="w-full p-3 border rounded" accept="image/*">
        </div>

        <div id="previewContainer" class="flex flex-wrap gap-4"></div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Submit</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('imageInput');
        const previewContainer = document.getElementById('previewContainer');

        let selectedFiles = [];

        // Handle image input change event
        imageInput.addEventListener('change', function (event) {
            const files = Array.from(event.target.files);

            files.forEach((file) => {
                // Check if file is an image
                if (!file.type.startsWith('image/')) return;

                // Add the file to the selected files array
                selectedFiles.push(file);

                // Create a FileReader to read the image
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.createElement('div');
                    preview.className = 'relative';
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="w-32 h-32 object-cover rounded-lg shadow">
                        <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1" onclick="removeImage(${selectedFiles.length - 1})">X</button>
                    `;
                    previewContainer.appendChild(preview);
                };
                reader.readAsDataURL(file);
            });

            // Clear the original input so the user can select the same file again
            imageInput.value = '';
        });

        // Function to remove an image preview and update the selected files array
        function removeImage(index) {
            selectedFiles.splice(index, 1);
            renderPreviews();
        }

        // Function to re-render all previews
        function renderPreviews() {
            previewContainer.innerHTML = '';
            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.createElement('div');
                    preview.className = 'relative';
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="w-32 h-32 object-cover rounded-lg shadow">
                        <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1" onclick="removeImage(${index})">X</button>
                    `;
                    previewContainer.appendChild(preview);
                };
                reader.readAsDataURL(file);
            });
        }

        // Handle form submission
        document.querySelector('form').addEventListener('submit', function (event) {
            const dataTransfer = new DataTransfer();

            // Add all selected files to the DataTransfer object
            selectedFiles.forEach(file => dataTransfer.items.add(file));

            // Assign the updated file list back to the original input
            imageInput.files = dataTransfer.files;
        });
    });
</script>
@endsection
