@extends('app', ['title' => 'Connect Your Stripe Account to Get Paid - TripPlanShop'])
@section('content')

    <div class="container">
        <div class="row">
            <div class="screen-height col-xs-12 col-md-10 col-md-offset-1 container-background">
                <h3>All We Need Is Your Payment Account</h3>

                <p>To become a seller, all you need to do is connect your TripPlanShop account to Stripe.</p>

                <p>Stripe is a trusted online payment service provider. All payment transactions at TripPlanShop are
                processed by Stripe. You can view transactions and transfer money to your bank
                account on Stripe website.
                </p>
                <p>Learn more about:</p>
                <ul class="">
                    <li><a href="{{ route('home.getSellerDetails') }}">Selling</a></li>
                    <li><a href="{{ route('home.getSellerDetails') }}" target="_blank">Pricing</a> </li>
                    <li><a target="_blank" href="https://stripe.com/ca">Stripe</a></li>
                </ul>

                <div class="">
                    <a href="https://connect.stripe.com/oauth/authorize?response_type=code&client_id={{env('STRIPE_CLIENT_ID')}}&scope=read_write">
                        <img id="stripe-connect" src="{{ env('SITE_IMAGE_PATH') . "connect_with_stripe.png" }}">
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@stop