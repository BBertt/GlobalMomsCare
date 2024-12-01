@extends('layouts.main')

@section('title', 'Appointments')

@section('content')

<h1>ADD APPOINTMENTS</h1>

<form action="{{ route('add.appointments') }}"method="POST">
    @csrf
    <label for="hospital_name">Name: </label>
    <input type="text" name="hospital_name" id="hospital_name">
    <label for="hospital_address">Address: </label>
    <input type="text" name="hospital_address" id="hospital_address">
    <label for="appointment_date">Appointment Date: </label>
    <input type="date" name="appointment_date" id="appointment_date">
    <button type="submit">Add Appointment</button>
</form>

@if ()
    
@endif

@endsection