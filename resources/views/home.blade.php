@extends('layouts.default')

@section('header')
@endsection

@section('content')
    <div class="jumbotron">
        <h1>Travel App</h1>
        <p>Find Flight and Hotel Deals</p>
        <div class="btn-group">
            <a href="{{ route('hotels.home') }}" class="btn btn-warning btn-lg">Hotels</a>
        </div>
        <div class="btn-group">
            <a href="#" class="btn btn-primary btn-lg">Flights</a>
        </div>
    </div>
@endsection
