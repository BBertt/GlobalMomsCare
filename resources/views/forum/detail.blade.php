@extends('layouts.main')

@section('title', 'Forum')

@section('content')
    {{ $forum->title }} <br>
    {{ $forum->account->name }} <br>
    @if($forum->pictures->isNotEmpty())
        @foreach ($forum->pictures as $picture)
            <img src="{{ asset('storage/' . $picture->pictureLink) }}" alt="{{ $forum->title }}" class="w-48 h-32 object-cover rounded">
        @endforeach
    @endif
    {{ $forum->content }}

    <h1>Comment</h1>

    @if($forum->comments->isNotEmpty())
        @foreach ($forum->comments as $comment)
            <h5>{{ $comment->content }}</h5>
            @if(auth()->check() && auth()->user()->id === $comment->account->id)
                <form method="POST" action="{{ route('comment.delete', ['id' => $comment->id, 'forumid' => $forum->id]) }}"  onsubmit="return confirm('Are you sure you want to delete this comment?')">
                    @csrf
                    <button class="bg-red-400">Delete</button>
                </form>
            @endif
        @endforeach
    @endif

    @if(auth()->check())
        <form method="POST" action="{{ route('comment.store', $forum->id) }}">
            @csrf
            <input type="text" name="comment" placeholder="input comment">
            <button type="submit">Submit</button>
        </form>
    @else
        <p>Must login to comment</p>
    @endif

@endsection
