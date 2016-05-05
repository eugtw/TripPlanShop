@extends('app', ['title' => 'TripPlanShop - Become a seller'])

@section('meta-description')
    <meta name="description" content="TripPlanShop is a marketplace for travel lovers to buy and sell trip plans around the world. Users can find detailed itineraries in any styles. TripPlanShop is the easiest way to monetize well planned itineraries.">
@stop

@section('content')

    <div id="become-seller-header">
        {{-- img in background --}}
        <div>
            <h1>Make itineraries with your travel style</h1>
            <p>Sale on a global scale</p>
        </div>
    </div>


    <div class="container" id="become-seller">
        <div class="row top-buffer">
            <div class="col-xs-12 text-center">
                <h2>Catch audience with travel personality</h2>
                <p class="col-xs-12 col-sm-8 col-sm-offset-2">Expose your trip plans to the right audience by
                tagging travel styles.</p>
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 col-sm-6 col-xs-12 top-buffer">
                <!-- should only contain one demo itinerary -->
                @foreach($itineraries as $key => $itinerary)
                    <div class="pop-itit-container">
                        @include('itinerary.partial_ItineraryDisplay', ['is_preview'=>1, 'key'=>$key])
                    </div>
                @endforeach
            </div>


            <div class="col-md-6 col-md-offset-1 col-sm-6 col-xs-12 top-buffer">
                <div class="become-seller-intro-block">
                    <h3>PERSONALIZED TRIP PLANS</h3>
                    <p>Our goal is that users can travel with little planning. Show your travel styles and specialty in your trip plans.
                        For any occasions: family vacations, marriage proposals, exotic parties, and festivals, etc.</p>
                </div>

                <div class="become-seller-intro-block">
                    <h3>WORLD IS YOUR MARKET</h3>
                    <p>Market your trip plans on social media to sell more. One great trip plan can sell fast and last long.</p>
                </div>

                <h3>EXPAND WHAT YOUR'VE GOT</h3>
                <p>Already in travel business? You can promote your websites and services by adding links to your trip plans.
                Grow your business with TripPlanShop.</p>

                <h4>travel bloggers & tour guides</h4>
                <p>Why not create travel itineraries from your postings and experiences? Add trip plan links on
                your websites, and sell them to people who already love your styles.</p>

                <div class="text-center top-buffer">
                    <a class="btn-primary itit-btn itit-footer-button" href="{{ url('/auth/register') }}" role="button">GET STARTED FREE</a>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>


@stop