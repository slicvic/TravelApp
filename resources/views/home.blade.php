@extends('layouts.default')

@section('header')
@endsection

@section('content')
    <div class="jumbotron">
        <h2>Find Flights and Hotels</h2>
        <form class="form-inline" action="index.html" method="post">
            <div class="form-group">
                <input type="text" class="form-control input-lg" placeholder="From" data-typeahead-cities>
            </div>
            <div class="form-group">
                <input type="text" class="form-control input-lg" placeholder="To" data-typeahead>
            </div>
            <div class="form-group">
                <input type="text" class="form-control input-lg" placeholder="Depart" data-datepicker>
            </div>
            <div class="form-group">
                <input type="text" class="form-control input-lg" placeholder="Return" data-datepicker>
            </div>
        </form>
    </div>
@endsection
