@extends('layouts.main')

@section('title', 'Order Detail')

@section('content')
    This is order detail
    @foreach ($orders as $order)
        {{ $order->product->name }}
    @endforeach
@endsection
