@extends('views.app', ['title' => 'How To Make Your Trip Plan A Cash Machine'])

@section('meta-description')
    <meta name="description" content="TripPlanShop is a marketplace for travel lovers to buy and sell trip plans around the world. Users can find detailed itineraries in any styles. TripPlanShop is the easiest way to monetize well planned itineraries.">
@stop

@section('content')

    <div id="hiw-container">
        <div id="hiw-header-container">
            <div class="container">
                <h1>Buy and Sell Travel Itineraries at TripPlanShop</h1>
            </div>
        </div>


        <div id="buyer-info-block">
            <div class="container">
                <h2 class="text-center">Find trip plans in your styles</h2>
                <div class="col-sm-4 col-xs-12 text-center top-buffer">
                    <i class="fa fa-question-circle fa-5x"></i>
                    <p class="hiw-img-caption">Lost in Planning?</p>
                    <p>You love to travel with more freedom, but you have no time to plan!</p>
                </div>
                <div class="col-sm-4 col-xs-12 text-center top-buffer">
                    <i class="fa fa-shopping-basket fa-5x"></i>
                    <p class="hiw-img-caption">Buy Itineraries</p>
                    <p>Search and buy itineraries of trips and more events that fit your style</p>
                </div>
                <div class="col-sm-4 col-xs-12 text-center top-buffer">
                    <i class="fa fa-heart fa-5x"></i>
                    <p class="hiw-img-caption">Enjoy the Moments</p>
                    <p>Enjoy easy and wonderful travel experience. Don't forget to leave reviews</p>
                </div>

                <div class="clearfix"></div>
            </div><!-- container -->
        </div><!-- buyer info block -->
        <div id="seller-info-block">
            <div class="container">
                <h2 class="text-center">Sell travel itineraries</h2>
                <div class="col-sm-4 col-xs-12 text-center top-buffer">
                    <i class="fa fa-pencil-square-o fa-5x"></i>
                    <p class="hiw-img-caption">Create Itineraries</p>
                    <p>Whether a day or long trip plans, even any event plans, post and sell them</p>
                </div>
                <div class="col-sm-4 col-xs-12 text-center top-buffer">
                    <i class="fa fa-users fa-5x"></i>
                    <p class="hiw-img-caption">Market and Sell More</p>
                    <p>Share your trip plans on your social web pages, and get more web traffic</p>
                </div>
                <div class="col-sm-4 col-xs-12 text-center top-buffer">
                    <i class="fa fa-usd fa-5x"></i>
                    <p class="hiw-img-caption">Earn Money</p>
                    <p>Make money selling your trip plans to the world</p>
                </div>

                <div class="clearfix"></div>

                <div class="text-center top-buffer2">
                    <a class="btn-primary itit-btn itit-footer-button" href="{{ route('home.getBecomingSeller') }}" role="button">Become a Seller</a>
                </div>
            </div><!-- container -->
        </div><!-- seller-info-block -->
    </div>

@stop