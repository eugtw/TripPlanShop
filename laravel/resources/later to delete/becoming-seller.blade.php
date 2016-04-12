@extends('app', ['title' => 'TripPlanShop - Become a seller'])

@section('meta-description')
    <meta name="description" content="TripPlanShop is a marketplace for travel lovers to buy and sell trip plans around the world. Users can find detailed itineraries in any styles. TripPlanShop is the easiest way to monetize well planned itineraries.">
@stop

@section('content')

    <div id="become-seller-header">
        {{-- img in background --}}
        <div>
            <h1>Sell on a global scale</h1>
            <h2>Create, post and monetize your trip plans with TripPlanShop</h2>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2" id="become-seller-container">
                <h2 class="top-buffer2">SELLING TRAVEL ITINERARIES</h2>

                <div class="top-buffer">
                    <h3>No Fee to List</h3>
                    <p>Becoming a seller to list travel itineraries is free.
                        You will pay % only when you earn money from sales.</p>

                    <h3 class="top-buffer">Multiplying Sales for One Great Itinerary</h3>
                    <p>Sell your travel itineraries to the world.
                        Create and share more on social pages to get more traffic and sales.</p>

                    <h3 class="top-buffer">Getting Started Is Easy</h3>
                    <ol>
                        <li>
                            <h4>Join TripPlanShop</h4>
                            <p>To buy and sell trip plans, you need to be a TripPlanShop member.
                                Joining only takes a minute and it doesn't cost a thing.</p>
                        </li>

                        <li>
                            <h4>Setup "Stripe" account for sales transactions</h4>
                            <p>To get paid for your sales, you need to create Stripe account and activate it.
                                Stripe, a trusted online payment service, has full control of sales transactions at TripPlanShop.</p>
                        </li>

                        <li>
                            <h4>Create your trip plans (travel itineraries)</h4>
                            <p>Create your travel itineraries for one day or long period trips, or any events, and set the price for sales. Last, publish them for sales and earn money.</p>
                        </li>
                    </ol>

                    <div class="text-center top-buffer">
                        <a href="{{ route('home.getSellerDetails') }}">Learn more about creating trip plans, pricing & stripe</a>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="text-center top-buffer">
                <a class="btn-primary itit-btn itit-footer-button" href="{{ route('user.stripeSignup') }}" role="button">BECOME SELLER</a>
            </div>
        </div><!-- row -->
    </div><!-- container -->
@stop