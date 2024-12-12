@extends('layouts.main')

@section('title', 'Appointments')

@section('content')

@if ($account->role == 'user')
    @include('appointments.user')

@elseif ($account->role == 'professional')
    @include('appointments.professional')

@endif

@endsection
