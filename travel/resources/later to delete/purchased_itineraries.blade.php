@extends('views.app', ['title' => 'Purchased Itineraries - TripPlanShop'])
@section('content')
    <div class="container">
        <div class="row">
            <h3 class="page-header">Favorite Itineraries</h3>

            @foreach($itineraries as $itinerary)
                <div class="col-md-4 col-sm-6 col-xs-12 iti_card">

                    @if( $itinerary->reviews->where('user_id',Auth::user()->id)->isEmpty() )
                        <!-- review star trigger modal -->
                        <a class="" href="#" data-toggle="modal" data-target="#myModal">
                            Rate this itinerary
                        </a>
                        <div class="clearfix"></div>
                    @endif

                    <div class="pop-itit-container top-buffer">


                        @include('views.itinerary.partial_ItineraryDisplay', ['purchased'=>1])
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- review Modal -->
    @include('views.itinerary.review_modal')
@stop