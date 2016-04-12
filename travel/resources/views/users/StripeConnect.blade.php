@extends('app', ['title' => 'Connect Your Stripe Account to Get Paid - TripPlanShop'])
@section('content')

    <div class="container">
        <div class="row">
            <div class="screen-height col-xs-12 col-md-10 col-md-offset-1 container-background">
                <h3>Connecting with Stripe</h3>
                <p>To become a seller, you must connect your TripPlanShop account to Stripe,
                a trusted online payment service provider. All payment transactions at TripPlanShop are
                processed by Stripe. You can view transactions and transfer money to your bank
                account on Stripe website.
                </p>
                <p>Learn more about <a href="{{ route('home.getSellerDetails') }}" target="_blank">pricing</a> and <a target="_blank" href="https://stripe.com/ca">Stripe</a></p>
                <div class="text-center">
                    <a href="https://connect.stripe.com/oauth/authorize?response_type=code&client_id={{env('STRIPE_CLIENT_ID')}}&scope=read_write">
                        <img src="{{ env('SITE_IMAGE_PATH') . "connect_with_stripe.png" }}">
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@stop