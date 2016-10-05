@extends('layouts.default')

@section('header')
@endsection

@section('content')
    <div class="jumbotron">
        <h2>Find Flights and Hotels</h2>
        <form class="form-inline" action="index.html" method="post">
            <div class="form-group">
                <input type="hidden" name="from_region_id" id="from-region-id-input">
                <input type="hidden" name="from_region_name" id="from-region-name-input">
                <input type="text" class="form-control input-lg" placeholder="Going from"
                    data-typeahead-regions
                    data-store-value="#from-region-id-input"
                    data-store-label="#from-region-name-input">
            </div>
            <div class="form-group">
                <input type="hidden" name="to_region_id" id="to-region-id-input">
                <input type="hidden" name="to_region_name" id="to-region-name-input">
                <input type="text" class="form-control input-lg" placeholder="Going to"
                    data-typeahead-regions
                    data-store-value="#to-region-id-input"
                    data-store-label="#to-region-name-input">
            </div>
            <div class="form-group">
                <input type="text" name="check_in_date" class="form-control input-lg" placeholder="Check in" data-datepicker>
            </div>
            <div class="form-group">
                <input type="text" name="check_out_date" class="form-control input-lg" placeholder="Check out" data-datepicker>
            </div>
        </form>
    </div>
@endsection
