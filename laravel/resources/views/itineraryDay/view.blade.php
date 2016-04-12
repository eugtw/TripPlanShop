<!-- days container -->
<div class="row" id="myDay">

    {{-- not to show the 1 day itinerary day details to public --}}
    @if(!$is_preview ||
        ($is_preview && $itinerary->days->count() > 1) )


    @foreach($itinerary->days($is_preview)->orderby('day_of_itinerary')->get() as $day)

        @include('itineraryDay.partial_DayView')

    @endforeach  {{-- end Day foreach --}}
    @endif
</div><!-- #myDay -->
