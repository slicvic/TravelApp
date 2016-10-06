@extends('layouts.default')

@section('header')
@endsection

@section('content')
    <div class="jumbotron">
        <h2>Find Hotel Deals</h2>
        <form class="form-inline" action="{{ route('hotels.search') }}" method="get">
            <div class="form-group">
                <input type="hidden" name="region_id" id="region-id-input">
                <input type="hidden" name="region_name" id="region-name-input">
                <input type="text" class="form-control input-lg" placeholder="Where"
                    data-typeahead-regions
                    data-value-field="#region-id-input"
                    data-label-field="#region-name-input">
            </div>
            <div class="form-group">
                <input type="text" name="check_in_date" class="form-control input-lg" placeholder="Check-in" data-datepicker>
            </div>
            <div class="form-group">
                <input type="text" name="check_out_date" class="form-control input-lg" placeholder="Check-out" data-datepicker>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg">Search</button>
            </div>
        </form>
    </div>
@endsection
