@extends('promo.promo-app')
@section('meta-description')
    <meta name="author" content="TripPlanShop">
    <meta name="description" content="Explore personalized trip plans by travel lovers. TripPlanShop is a marketplace for travel lovers to buy and sell trip plans around the world. Find the perfect travel itineraries that fit your styles.">
@stop
@section('meta-og')
    <meta property="og:url"                content="{{ url('/promo') }}">
    <meta property="og:type"               content="article">
    <meta property="og:title"              content="{{ 'TripPlanShop | Find Trip Plans For Your Styles' }}">
    <meta property="og:description"        content="{{ 'Overwhelmed? Want more than general travel guide? Our day-by-day
    trip plans can save you time searching, so you can enjoy more during trips.' }}">
    <meta property="og:image"              content="http://tripplanshop.com/images/site/promo-mar-16.png">
    <meta property="og:site_name"           content=""/>
    <meta property="fb:app_id"             content="{{ env('FB_CLIENT_ID') }}"
@stop
@section('content')
    <header class="text-center" id="pm-header">
        <a href="/promo"><img id="pm-logo" src="{{ env('SITE_IMAGE_PATH') . 'promo-logo.jpg' }}" alt="logo"></a>

        <div id="pm-header-text-box">
            <div class="container">
                <div class="row">
                    <!-- messages -->
                    @if($errors->any())

                            <div class="text-center alert alert-danger col-sm-6 col-sm-offset-3 col-xs-12">
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                    @endif
                    @if (session('status'))
                            <div class="text-center alert alert-success col-sm-6 col-sm-offset-3 col-xs-12">
                                {{ session('status') }}
                            </div>

                    @endif
                    @if(Session::has('message'))
                            <div class="text-center alert alert-success col-sm-6 col-sm-offset-3 col-xs-12">
                                {{ Session::get('message') }}
                            </div>
                    @endif
                </div><!-- messages -->
            </div>

            <P class="pm-header-banner text-center">OPENING SOON!!</P>
            <h1 class="text-center">Lost In Travel Planning?</h1>
            <h2>Find trip plans that fit your travel styles</h2>

            <div class="text-center pm-button">
                <div class="">
                    <a class="" href="#pm-how-it-works">How it works</a>
                    <a class="" href="#pm-become-a-seller">Have trip plans?</a>
                </div>

                <p class="text-center">already a seller? <a href="" data-toggle="modal" data-target="#loginModal">Log in</a></p>
            </div>

            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div id="addthis-toolbox">
                <div class="addthis_sharing_toolbox inline-block"></div>
            </div>
        </div>
    </header>

    <div id="pm-how-it-works">
        <div class="container">
            <div class="row top-buffer2 bottom-buffer">
                <h3 class="text-center col-xs-12 pm-info-box-title">Experience Destinations Like Insiders</h3>

                <div class="col-md-5 col-sm-6 col-xs-12 top-buffer">
                    <div class="pm-intro-box">
                        <a href="{{ url('/promo/itinerary-example') }}">
                            <img src="{{ env('SITE_IMAGE_PATH') . 'promo-iti-card.jpg' }}">
                        </a>

                    </div>
                </div>
                <div class="col-md-6  col-sm-6 col-xs-12 top-buffer">
                    <div class="pm-intro-box">
                        <div class="become-seller-intro-block">
                            <h3>No trip plan fits what you want?</h3>
                            <p>Our trip plans are designed by people like you: people who love to travel. Trip plans suit
                                different travel styles that are unique personality and lifestyle. Adventurous. Romantic.
                                Family-friendly. Define your travel style, and find trip plans just right for you.
                            </p>
                        </div>

                        <div class="become-seller-intro-block">
                            <h3>Want more than a general travel guide?</h3>
                            <p>Our trip plan writers focus on insights, experiences, and tips rather than general descriptions.</p>
                        </div>

                        <h3>Overwhelmed? Lost in travel planning?</h3>
                        <p>Our day-by-day trip plans can save you time searching.
                            Relax before your trip and enjoy more time during trips.
                        </p>

                        <a href="{{ url('/promo/itinerary-example') }}">See our trip plan example</a>
                        <div class="text-center top-buffer">
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#contactModal">
                                Notify Me When Fully Open
                            </button>
                        </div>

                    </div>
                </div>
            </div><!-- itit row -->
        </div><!-- container -->
    </div>

    <div id="pm-become-a-seller">
        <div class="container">
            <div class="row top-buffer2">
                <h3 class="text-center  col-xs-12 pm-info-box-title">List your trip plans for sale or share for free</h3>
                <p class="text-center col-xs-12 col-sm-6 col-sm-offset-3">Get rewarded for your travel experiences and hard work. Or share
                trip plans for free to expose your web pages or travel businesses.</p>
                <div class="col-md-6  col-sm-6 col-xs-12 top-buffer">
                    <div class="pm-intro-box">
                        <div class="become-seller-intro-block">
                            <h3>Great way to promote</h3>
                            <p>Are you a blogger or in travel business? Include any links in trip plans to promote your services.
                                Trip plans can be for sale or share.</p>
                        </div>

                        <div class="become-seller-intro-block">
                            <h3>Share, sell, and gain together</h3>
                            <p>Share trip plans on social media to gain traffic. Together, we are creating a market.</p>
                        </div>

                        <h3>Catch audience with travel styles</h3>
                        <p>Secure the right audience with style tags: #kid-friendly,
                            #romantic, #adventurous, #marriage proposal.</p>

                        <div class="text-center top-buffer">
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#sellerModal">
                                Join to See How to Sell
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6  col-xs-12 top-buffer">
                    <div class="pm-intro-box">
                        <img src="{{ env('SITE_IMAGE_PATH') . 'promo-seller.jpg' }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="pm-footer" class="text-center">
        <div class=" text-center">
            <ul class="list-unstyled list-inline"
                <li><a href="#" data-toggle="modal" data-target="#loginModal">Login </a></li><span> | </span>
                <li><a href="#" data-toggle="modal" data-target="#sellerModal">Join</a></li><span> | </span>
                <li><a href="#" data-toggle="modal" data-target="#contactModal">Contact</a></li>
            </ul>
        </div>


        <p class="text-center">&copyTripPlanShop 2016</p>
    </div>




    <!-- loginModal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="{{ url('/auth/login') }}" class="form-signin">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <h2 class="login">Login</h2>
                        <label for="email" class="sr-only">Email address</label>
                        <input type="email" name="email" class="form-control" value="{{Request::cookie('last_user')}}" placeholder="Email address" required autofocus>
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="1" checked> Remember me
                            </label>
                        </div>
                        <button class="btn btn-block" type="submit">Sign in</button>
                        <div>
                            <a class="btn btn-facebook btn-block" href="{{ url('/auth/facebook') }}" role="button"><i class="fa fa-lg fa-facebook pull-left"></i>Sign in with Facebook</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- sellerodal -->
    <div class="modal fade" id="sellerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="{{ url('/auth/register') }}" class="form-signin">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h2 class="form-signin-heading">Sign up</h2>
                        <label for="name" class="sr-only">User Name</label>
                        <input type="name" name="name" class="form-control" placeholder="User Name" value="{{old('name')}}" required autofocus>

                        <label for="email" class="sr-only">Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email address" value="{{old('email')}}" required>

                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>

                        <label for="password_confirmation" class="sr-only">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>

                        <button class="btn btn-primary btn-block" type="submit">Sign up</button>
                        <div>
                            <a class="btn btn-facebook btn-block" href="{{ url('/auth/facebook') }}" role="button"><i class="fa fa-lg fa-facebook pull-left"></i>Sign up with Facebook</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- contactModal -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    {!! Form::open(['route' => 'promo.postNotifyMe', 'class' => 'form-signin']) !!}
                        <h2 class="login">Notify me when open</h2>
                        {!!  Form::label('email', 'Email', ['class' => 'sr-only']) !!}
                        {!!  Form::email('email', null, ['required', 'class'=>'form-control', 'placeholder' => 'Email Address']) !!}

                        <button class="btn btn-block" type="submit">Send</button>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop