@if($is_preview == 1)
    <div class="iti-info-box">
        @if( $itinerary->price == 0 )
            <a type="button" class="header-buy-button" href="{{ route('itinerary.getItitFree', $itinerary) }}">Get this</a>
        @else
            <a type="button" class="header-buy-button" href="{{ route('itinerary.purchaseConfirm', $itinerary) }}">Buy</a>
        @endif

        <div class="iti-price">
            @if($itinerary->price == 0)
                <span>Free</span>
            @else
                <sup>$</sup><span>{{ $itinerary->price }}</span><sup> US</sup>
            @endif
            <a id="{{ $itinerary->getRouteKey() }}" href="{{ route('itinerary.favorite',$itinerary) }}">
                <span class="glyphicon glyphicon-heart heart {{ $itinerary->liked() ? 'theme-pink' : ''}}"></span>
            </a>
        </div><!-- pv-header-info-price -->

    </div>
@endif