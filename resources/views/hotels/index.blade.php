@extends('layouts.default')

@section('header')
@endsection

@section('content')
    <div class="jumbotron">
        <h2>Find Hotel Deals</h2>
        <form method="get" action="{{ route('hotels.search') }}" id="hotel-search-form">
            <div class="form-group">
                <label>Destination</label>
                <input type="hidden" name="region[id]" id="hotel-search-form-region-id">
                <input type="hidden" name="region[airport_code]" id="hotel-search-form-airport-code">
                <input
                    type="text"
                    name="region[name]"
                    class="form-control input-lg js-typeahead-regions"
                    placeholder="e.g. city, region, district or specific hotel"
                    required_
                    data-bind-field-region-id="#hotel-search-form-region-id"
                    data-bind-field-region-airport-code="#hotel-search-form-airport-code">
            </div>

            <div class="form-group">
                <label>Check-in</label>
                <div class="input-group">
                    <input
                        type="text"
                        name="check_in_date"
                        class="form-control input-lg js-datepicker"
                        required_
                        placeholder="mm/dd/yyyy">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>

            <div class="form-group">
                <label>Check-out</label>
                <div class="input-group">
                    <input
                        type="text"
                        name="check_out_date"
                        class="form-control input-lg js-datepicker"
                        required_
                        placeholder="mm/dd/yyyy">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>

            <div class="form-group">
                <label>Rooms</label>
                <select class="form-control" name="rooms">
                    @for ($i = 1; $i <= 3; $i++)
                        <option value="{{ $i }}">{{ $i }} {{ ($i == 1) ? 'room' : 'rooms' }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label>Adults</label>
                <select class="form-control" name="adults">
                    @for ($i = 1; $i <= 6; $i++)
                        <option value="{{ $i }}">{{ $i }} {{ ($i == 1) ? 'adult' : 'adults' }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label>Children</label>
                <select class="form-control" name="children" v-model="numChildren">
                    @for ($i = 0; $i <= 6; $i++)
                        <option value="{{ $i }}">{{ $i }} children</option>
                    @endfor
                </select>
            </div>

            <div style="display:none" v-show="numChildren > 0">
                <div v-for="n in Number(numChildren)">
                    <select name="children_ages[]" class="form-control">
                        @for ($i = 0; $i <= 17; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg">Search</button>
            </div>
        </form>
    </div>
@endsection

@section('javascripts')
    <script src="/app/js/hotels/hotel-search-form.js"></script>
@endsection
