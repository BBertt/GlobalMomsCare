@extends('layouts.main')

@section('title', 'Profile Page')

@section('content')
    <div>
        <h1>{{ $user->name }}</h1>
        <h3>Article</h3>
        @foreach ($articles as $article)
            <h4>{{ $article->title }}</h4>
        @endforeach
        <h3>Forums</h3>
        @foreach ($forums as $forum)
            <h4>{{ $forum->title }}</h4>
        @endforeach
        <h3>Comments</h3>
        @foreach ($comments as $comment)
            {{ $comment->content }}
        @endforeach
    </div>
@endsection
