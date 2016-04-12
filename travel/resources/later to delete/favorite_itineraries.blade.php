@extends('views.app')
@section('content')
    <div class="container">
        <div class="row">
            <h3 class="page-header">Favorite Itineraries</h3>

            @foreach($itineraries as $itinerary)
                <div class="col-sm-4 col-xs-12 iti_card">
                    <div class="pop-itit-container top-buffer">
                     @include('views.itinerary.partial_ItineraryDisplay', ["purchased"=>0])
                     </div>
                </div>
            @endforeach
            
        </div>
    </div>
@stop