@extends('layouts.default')

@section('header')
@endsection

@section('content')
    <div class="jumbotron">
        <h2>Find Hotel Deals</h2>
        @include('flash-messages/error', ['errors' => $errors])

        <form method="get" action="{{ route('hotels.search') }}" id="hotel-search-form">
            <div class="form-group">
                <label>Destination</label>
                <input
                    type="hidden"
                    name="region[id]"
                    value="{{ old('region.id') }}"
                    id="hotel-search-form-region-id">
                <input
                    type="hidden"
                    name="region[airport_code]"
                    value="{{ old('region.airport_code') }}"
                    id="hotel-search-form-airport-code">
                <input
                    type="text"
                    name="region[name]"
                    class="form-control input-lg js-typeahead-regions"
                    placeholder="e.g. city, region, district or specific hotel"
                    value="{{ old('region.name') }}"
                    data-bind-field-region-id="#hotel-search-form-region-id"
                    data-bind-field-region-airport-code="#hotel-search-form-airport-code">
            </div>

            <div class="form-group">
                <label>Check-in</label>
                <div class="input-group">
                    <input
                        type="text"
                        name="checkin_date"
                        class="form-control input-lg js-datepicker"
                        placeholder="mm/dd/yyyy"
                        value="{{ old('checkin_date') }}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>

            <div class="form-group">
                <label>Check-out</label>
                <div class="input-group">
                    <input
                        type="text"
                        name="checkout_date"
                        class="form-control input-lg js-datepicker"
                        placeholder="mm/dd/yyyy"
                        value="{{ old('checkout_date') }}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>

            <div class="form-group">
                <label>Rooms</label>
                <select class="form-control" name="rooms">
                    @for ($i = 1; $i <= 3; $i++)
                        <option value="{{ $i }}"{{ ($i == old('rooms')) ? ' selected' : '' }}>{{ $i }} {{ ($i == 1) ? 'room' : 'rooms' }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label>Adults (18+)</label>
                <select class="form-control" name="adults">
                    @for ($i = 1; $i <= 6; $i++)
                        <option value="{{ $i }}"{{ ($i == old('adults')) ? ' selected' : '' }}>{{ $i }} {{ ($i == 1) ? 'adult' : 'adults' }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label>Children (0-17)</label>
                <select class="form-control" name="children" v-model="children">
                    @for ($i = 0; $i <= 6; $i++)
                        <option value="{{ $i }}"{{ ($i == old('children')) ? ' selected' : '' }}>{{ $i }} children</option>
                    @endfor
                </select>
            </div>

            <div style="{{ (count(old('children_ages'))) ? 'display:block' : 'display:none' }}" v-show="children > 0">
                <div class="form-group" v-for="(n, index) in Number(children)">
                    <label>Child @{{ n }} age</label>
                    <select name="children_ages[]" class="form-control" v-model="childrenAges[index]">
                        <option value="">Age</option>
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
    <script>
        hotelSearchForm.children = '{{ old('children', 0) }}'
        hotelSearchForm.childrenAges = {!! json_encode(old('children_ages', [])) !!};
    </script>
@endsection
