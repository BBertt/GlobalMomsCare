@extends('layouts.main')

@section('title', 'Profile Page')

@section('content')
    <div class="container">
        <h1>{{ $user->name }}</h1>

        {{-- Button Group --}}
        <div class="btn-group mb-4 flex" role="group" aria-label="Profile Toggle Button Group">
            @if ($user->role === "professional")
                <input type="radio" class="hidden" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label for="btnradio1" onclick="toggleSection('articles')"
                    class="cursor-pointer bg-red-500 text-white px-4 py-2 rounded-l-lg hover:bg-red-600 transition">
                    Articles
                </label>
            @endif

            <input type="radio" class="hidden" name="btnradio" id="btnradio2" autocomplete="off">
            @if ($user->role === "professional")
                <label for="btnradio2" onclick="toggleSection('forums')"
                class="cursor-pointer bg-red-500 text-white px-4 py-2 hover:bg-red-600 transition">
            @else
                <label for="btnradio2" onclick="toggleSection('forums')"
                class="cursor-pointer bg-red-500 text-white px-4 py-2 hover:bg-red-600 transition rounded-l-lg">
            @endif
                Forums
            </label>

            <input type="radio" class="hidden" name="btnradio" id="btnradio3" autocomplete="off">
            <label for="btnradio3" onclick="toggleSection('comments')"
                class="cursor-pointer bg-red-500 text-white px-4 py-2 rounded-r-lg hover:bg-red-600 transition">
                Comments
            </label>
        </div>

        {{-- Articles Section --}}
        @if ($user->role === "professional")
            <div id="articles" class="toggle-section active">
                <h3>Articles</h3>
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
                            <form method="POST" action="{{ route('articles.delete', $article->id) }}" onsubmit="return confirm('Are you sure you want to delete this article?')" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                            <a href="/article/update/{{ $article->id }}">
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Update
                                </button>
                            </a>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500">No articles found.</p>
                    @endforelse
                </div>
            </div>
        @endif

        {{-- Forums Section --}}
        @if ($user->role === "professional")
            <div id="forums" class="toggle-section">
        @else
            <div id="forums" class="toggle-section active">
        @endif
            <h3>Forums</h3>
            @foreach ($forums as $forum)
                <a href="{{ route('forums.show', $forum->id) }}" class="no-underline">
                    <div class="bg-gray-50 shadow-md rounded-lg mb-6 p-4 flex flex-col md:flex-row items-start md:items-center hover:bg-gray-200">
                        <div class="w-full md:w-1/6">
                            @if($forum->pictures->isNotEmpty())
                                <img src="{{ asset('storage/' . $forum->pictures->first()->pictureLink) }}" alt="{{ $forum->title }}" class="w-48 h-32 object-cover rounded">
                            @else
                                <div class="bg-gray-200 w-full h-32 flex items-center justify-center rounded">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 ml-4">
                            <h2 class="text-xl font-bold text-gray-800 mb-0">{{ $forum->title }}</h2>
                            <h6 class="text-sm font-semibold text-gray-500">By {{ $forum->account->name }}</h6>
                            <p class="text-gray-600 mt-2">{{ Str::limit($forum->content, 150, '...') }}</p>
                        </div>
                        <div>
                            <form method="POST" action="{{ route('forums.delete', $forum->id) }}" onsubmit="return confirm('Are you sure you want to delete this forum?')" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                            <a href="/forums/update/{{ $forum->id }}">
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Update
                                </button>
                            </a>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Comments Section --}}
        <div id="comments" class="toggle-section">
            <h3>Comments</h3>
            @if($comments->isNotEmpty())
                <div class="space-y-4">
                    @foreach ($comments as $comment)
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <div class="flex gap-2 items-center">
                                <p class="text-base text-gray-600 mb-2"><span class="font-bold">{{ $comment->account->name }}</span></p>
                                @if($comment->account->role == "professional")
                                    <p class="text-xs text-white mb-2 bg-red-500 p-1 rounded-md">Professional</p>
                                @endif
                            </div>
                            <p class="text-gray-800 text-sm mb-0">{{ $comment->content }}</p>
                            <form method="POST" action="{{ route('comment.delete.profile', $comment->id) }}" onsubmit="return confirm('Are you sure you want to delete this comment?')" class="mt-2">
                                @csrf
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No comments yet. Be the first to comment!</p>
            @endif
        </div>
    </div>
    <script>
        function toggleSection(sectionId) {
            const sections = document.querySelectorAll(".toggle-section");
            sections.forEach((section) => {
                if (section.id === sectionId) {
                    section.classList.add("active");
                } else {
                    section.classList.remove("active");
                }
            });
        }
    </script>
@endsection
