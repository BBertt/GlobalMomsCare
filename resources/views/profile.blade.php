@extends('layouts.main')

@section('title', 'Profile Page')

@section('content')
    <div class="container">
        <h1>{{ $user->name }}</h1>

        {{-- Articles Section --}}
        @if ($user->role === "professional")
            <h3>Articles</h3>
            @foreach ($articles as $article)
                <h4>{{ $article->title }}</h4>
            @endforeach

            {{-- Pagination for Articles --}}
            <div class="mt-4">
                {{ $articles->links() }}
            </div>
        @endif

        {{-- Forums Section --}}
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
                </div>
            </a>
        @endforeach

        {{-- Pagination for Forums --}}
        <div class="mt-4">
            {{ $forums->links() }}
        </div>

        {{-- Comments Section --}}
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
                        @if(auth()->check() && auth()->user()->id === $comment->account->id)
                            <form method="POST" action="{{ route('comment.delete', ['id' => $comment->id, 'forumid' => $comment->forum->id]) }}" onsubmit="return confirm('Are you sure you want to delete this comment?')" class="mt-2">
                                @csrf
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Pagination for Comments --}}
            <div class="mt-4">
                {{ $comments->links() }}
            </div>
        @else
            <p class="text-gray-500">No comments yet. Be the first to comment!</p>
        @endif
    </div>
@endsection
