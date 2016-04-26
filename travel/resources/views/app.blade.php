<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{{ $title or 'TripPlanShop: Trip Plans Marketplace | Travel Itineraries & Guides'}}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	@yield('meta-description')
	@yield('meta-og')

	<meta name="keywords" content="tripplanshop, shop,travel, itinerary, trip, backpacking, vacation, getaway, tour, plan, planning, experience">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- fav icon -->
	<link rel="shortcut icon" href="{{ asset('images/site/favicon.ico') }}">


	<!--
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>  -->


	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<!-- jQuery -->
	<script   src="https://code.jquery.com/jquery-1.12.3.min.js"
			  integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="
			  crossorigin="anonymous">

	</script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<!-- select2
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>-->

	<!-- colorbox
	<script src="{{ asset('/js/colorbox/jquery.colorbox.js') }}"></script>-->

	<!-- matchHeight -->
	<script src="{{ asset('/js/matchHeight/jquery.matchHeight.js') }}"></script>

	<!-- dotdotdot
	<script src="{{ asset('/js/dotdotdot/jquery.dotdotdot.js') }}"></script>-->

	<!-- multiselect -->
	<script src="/js/multiselect/bootstrap-multiselect.js"></script>


	<!--
	<script src="{{ asset('/packages/barryvdh/elfinder/js/standalonepopup.js') }}"></script>
	<script src="{{ asset('/packages/barryvdh/elfinder/js/standalonepopup.js') }}">
    //standalone elfinder
</script>-->




	<link href="/css/app.css" rel="stylesheet">
	<link href="/css/all.css" rel="stylesheet">

	<!-- sticky navbar -->
	<script src="{{ asset('js/sticky/jquery.sticky.js') }}"></script>

	<!-- starr -->
	<script src="{{ asset('/js/starrr.min.js')  }}"></script>

	<!-- sweet alert -->
	<script src="/js/sweetalert/sweetalert.min.js"></script>

	<!-- swiper -->
	<script src="/js/swiper/swiper.js"></script>
	<script src="/js/swiper/swiper.jquery.js"></script>


	<!-- dropzone -->
	<script src="/js/dropzone/dropzone.js"></script>


	<!-- unite gallery
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
	<link rel='stylesheet' href='/unitegallery/themes/default/ug-theme-default.css' type='text/css' />-->
	<script type='text/javascript' src='/unitegallery/js/unitegallery.min.js'></script>

	<link rel='stylesheet' href='/unitegallery/css/unite-gallery.css' type='text/css' />
	<script type='text/javascript' src='/unitegallery/themes/grid/ug-theme-grid.js'></script>



	<!-- Stripe -->
	<script src="https://checkout.stripe.com/checkout.js"></script>

	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56874d094d1fe552" async="async"></script>

	<script>
		jQuery(document).ready(function(){
			jQuery("#sticky").sticky({topSpacing:0});
		});
	</script>

	@yield('javascript-block')
</head>
<body>
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
					<a class="navbar-brand" href="{{ url('home') }}"><img alt="logo" class="img-responsive" src="{{ env('SITE_IMAGE_PATH') . 'logo.jpg' }}"> </a>
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
										<li><a class="popup_selector" data-inputid="image">My Photo Gallery</a></li>
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



		<div class="push"></div>
	</div><!-- .wrapper -->

	<script src="/js/all.js"></script>
	@yield('javascriptfooter5')


	@include('includes.footer')
</body>
</html>
