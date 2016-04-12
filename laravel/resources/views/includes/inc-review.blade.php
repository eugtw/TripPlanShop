<!-- review star -->
<a href="#" data-toggle="modal" data-target="#reviewModal_{{ $itinerary->getRouteKey() }}">
    <div class="rating">
                    <span>
                        @if($itinerary->reviews()->count() < 3)
                            {{"New!"}}
                        @else
                            {{ round($itinerary->reviews()->avg('rating'),1) }}
                        @endif
                    </span>
        <span class="glyphicon glyphicon-star"></span>
        <span>( {{ $itinerary->reviews()->count() }} review{{$itinerary->reviews()->count() > 1 ? 's)' : ')'}}</span>
    </div>
</a>