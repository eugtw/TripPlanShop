@extends('views.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2 class="page-header">{{strtoupper($user->name)}}'s Itineraries</h2>
                @foreach($itineraries as $itinerary)
                    <div class="col-md-4 col-sm-6 col-xs-12 top-buffer">
                        <div class="pop-itit-container">
                            @include('views.itinerary.partial_ItineraryDisplay', ['purchased'=>0])
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    @stop