hotel search

@foreach ($data['hotelList'] as $hotel)
<div class="media">
    <div class="media-left">
        <a href="#">
            <img class="media-object" src="..." alt="...">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading">{{ $hotel['name'] }}</h4>

    </div>
</div>
@endforeach
