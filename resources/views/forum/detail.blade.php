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
        @endforeach
    @endif
    
@endsection
