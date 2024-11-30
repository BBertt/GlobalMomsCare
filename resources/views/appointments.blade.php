@extends('layouts.main')

@section('title', 'Appointments')

@section('content')
{{-- hospital (name and address), schedule (date) --}}

<h1>Hospitals</h1>

<form action="{{ route('add.appointments') }}"method="POST">
    @csrf
    <label for="hospital-name">Name: </label>
</form>

<h1>Schedule</h1>
@endsection