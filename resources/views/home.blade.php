@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <h1>Home</h1>
    @auth
        <p>Welcome, {{ Auth::user()->name }}! You are logged in.</p>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    @endauth
@endsection
