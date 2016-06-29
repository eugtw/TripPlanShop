<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{{ $title or 'TripPlanShop: Travel Itineraries & Guides Marketplace' }}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	@yield('meta-description')
	@yield('meta-og')

	<meta name="keywords" content="tripplanshop, shop,travel, itinerary, trip, backpacking, vacation, getaway, tour, plan, planning, experience">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<!-- fav icon -->
	<link rel="shortcut icon" href="{{ asset('images/site/favicon.ico') }}">

	<!-- ckeditor -->
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<!-- Stripe -->
	<script src="https://checkout.stripe.com/checkout.js"></script>

	<!-- unite gallery-->
	<link rel='stylesheet' href='/unitegallery/css/unite-gallery.css' type='text/css' />
	<script type='text/javascript' src='/unitegallery/themes/grid/ug-theme-grid.js'></script>
	<script type='text/javascript' src='/unitegallery/js/unitegallery.min.js'></script>

	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56874d094d1fe552" async="async"></script>

	<link href="/css/app.css" rel="stylesheet">
	<link href="/css/all.css" rel="stylesheet">
	<script src="/js/app.js"></script>


	@include('includes.analyticsTracking')
	@yield('snippet-data')
	@yield('javascript-block')
</head>
<body data-spy="scroll" data-target="#sticky-nav">
	<div class="wrapper" id="top">
		<nav class="navbar navbar-default mynav">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand tps-brand" href="{{ url('home') }}"><img alt="logo" class="img-responsive" src="{{ env('SITE_IMAGE_PATH') . 'logo.jpg' }}"> </a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">

						@if(isset($homepage))
							<li><a href="#how-it-works">How It Works</a></li>
							@endif

							@if(! (Auth::check() && Auth::user()->stripe_active == 1))
								<li id="nav-link-theme"><a href="{{ route('home.getBecomingSeller') }}">Become a Seller</a></li>
						@endif


						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Help<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ route('home.getFaqs') }}">FAQs</a></li>
								<li><a href="{{ route('home.getSellerDetails') }}">Selling</a></li>
								<li><a href="{{ url('/password/email') }}">Password reset</a></li>
								<li><a href="{{ route('auth.getActivation') }}">Account activation</a></li>
								<li><a href="{{ route('home.getContactus') }}">Contact</a></li>
							</ul>
						</li>

						@if (Auth::guest())
							<li><a href="{{ url('/auth/login') }}">Login</a></li>
							<li><a href="{{ url('/auth/register') }}">Join</a></li>
						@else
							<li class="dropdown" >
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenuDivider">
									<li><a href="{{ route('user.show', [Auth::user()]) }}">Profile</a></li>
									<li><a href="{{ route('user.getAllTripPlans', [Auth::user()]) }}">My Trip Plans</a></li>
									<li><a href="{{ route('user.liked', [Auth::user()]) }}">Wish list</a></li>


									@if(Auth::user()->stripe_active)
										<li role="separator" class="divider"></li>
										<li><a href="{{ route('itinerary.create') }}">Create Plans</a></li>
										<li><a href="https://dashboard.stripe.com/login" target="_blank">Stripe Login</a></li>
									@endif

									<li role="separator" class="divider"></li>
									<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
								</ul>

							</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		<!-- messages -->
		@if($errors->any())
			<div class="container">
				<div class="text-center alert alert-danger col-sm-6 col-sm-offset-3 col-xs-12 top-buffer">
					@foreach($errors->all() as $error)
						<p>{{ $error }}</p>
					@endforeach
				</div>
			</div>
		@endif
		@if (session('status'))
			<div class="container">
				<div class="text-center alert alert-success col-sm-6 col-sm-offset-3 col-xs-12 top-buffer">
					{{ session('status') }}
				</div>
			</div>

		@endif
		@if(Session::has('message'))
			<div class="container">
				<div class="text-center alert alert-success col-sm-6 col-sm-offset-3 col-xs-12 top-buffer">
					{{ Session::get('message') }}
				</div>
			</div>
		@endif

		@yield('content')


		<div class="loading-modal">
			<div class="loading-message">
				<i class="fa fa-spinner fa-spin fa-2x fa-fw theme-blue"></i>
				<span class="sr-only">Loading...</span>
			</div>
		</div>

		<div class="push"></div>
	</div><!-- .wrapper -->


	@include('includes.footer')


	@yield('js-bottom')
	<script src="/js/all.js"></script>

</body>
</html>
