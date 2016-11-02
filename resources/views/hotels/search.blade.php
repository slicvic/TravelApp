hotel search

@if (empty($data['hotelList'] ))
    <div class="alert alert-danger">
        <strong><i class="fa fa-times"></i></strong> Sorry, we couldn't find prices or availability for your request.
    </div>
@else
    @each('hotels.partials.search-results-list-item', $data['hotelList'], 'hotel');
@endif
