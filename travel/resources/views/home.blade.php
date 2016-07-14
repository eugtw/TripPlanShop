@extends('app', ['homepage'=>1, 'title' => 'TripPlanShop: Self-guided trip plans with personalities'])

@section('meta-description')
	<meta name="author" content="TripPlanShop">
	<meta name="description" content="Explore personalized trip plans by travel lovers. TripPlanShop is a marketplace for travel lovers to buy and sell trip plans around the world. Find the perfect travel itineraries that fit your styles.">
@stop

@section('content')
	<header class="text-center">
		<div id="header-img">
			<h1>Self-guided Trip Plans With Personalities</h1>
			<h2>Follow the paths of experienced travellers</h2>
			<a class="btn btn-primary" id="header-search-btn-mobile" href="#" data-toggle="modal" data-target="#myModal">FIND PLANS</a>

			<div id="header-search">
				{!! Form::open(['url'=>'itinerary-search','method'=>'GET', 'class'=>'form-inline']) !!}
				<!--
					<div class="home-style-search">
						{!! Form::label('style_list', 'Style Select',['hidden'=>'true']) !!}
						{!! Form::select('style_list[]', $travelStyles,null,['id'=>'style_list', 'class'=>'style_list', 'multiple'=>'multiple']) !!}
					</div>
				-->
				<div class="form-group searchbar">
					{!! Form::label('location','123',['class'=>'sr-only']) !!}
					{!! Form::text('location', null,['class'=> 'form-control', 'placeholder'=>'Where are you going?','id' => 'autocomplete', 'onFocus'=>'geolocate()']) !!}
				</div>
				<!--
					{!! Form::label('country_name', 'Country Select',['hidden'=>'true']) !!}
					{!! Form::select('country_name', (['any'=>'any country'] +$travelCountries), 1) !!}
				-->
				<div class="form-group searchbar">
					{!! Form::submit('FIND PLANS', ['class'=>'btn btn-primary', 'id'=>'iti-search-btn']) !!}
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</header>


	<div class="container">
		<div class="row">
			{{-- how it works div --}}
			<div id="sell-trip-plan" class="col-xs-12 top-buffer">
				<div class="col-md-5 col-xs-12">
					<h2>Sell Personalized Trip Plans</h2>

					<p>Are you a travel expert or blogger? </p>
					<p>Earn money sharing your trip plans that show your travel personality.</p>

					<a href="{{ route('home.getBecomingSeller') }}">See What You Can Get</a>

				</div>
				<div id="sell-trip-plan-img" class="col-md-7 col-xs-12">
					<!-- img thru background -->
				</div>
			</div>
		</div>


		<div class="row top-buffer2">
			<h2 class="text-center hp-iti-header col-xs-12">Popular Trip Plans</h2>
			<p class="text-center col-xs-12">Find out what trip plans sold most look like</p>
			@foreach($pop_itineraries as $key => $itinerary)
				<div class="col-md-4 col-sm-6 col-xs-12 top-buffer">

					@include('itinerary.partial_ItineraryDisplay', ['is_preview'=>1, 'key'=>$key])

				</div>
			@endforeach

			<div class="clearfix"></div>

			<div class="col-sm-4 col-sm-offset-4 col-xs-offset-1 col-xs-10 top-buffer">
				<a class="pop-link-btn" href="{{ route('itinerary.getPopTripPlansPage') }}">See All Popular Trip Plans</a>
			</div>

		</div><!-- itit row -->
	</div><!-- container -->


	<div class="hp-style-block">
		<div class="container">
			<h2 class="text-center hp-style-header col-xs-12">Popular Styles</h2>

			<div class="row">
				@foreach($pop_styles as $key => $s)
					<div class="col-sm-4 col-xs-12 top-buffer">
						<a href="{{'/itinerary-search?' . http_build_query( ['style_list[]' => $s->style ])}}">
							<div class="pop-style-dis-box" style="background-image: url('{{ env('SITE_IMAGE_PATH') . 'styles/' . strtolower($s->style) . '.jpg' }}')">

								<div >
									<h3>{{ strtoupper($s->style) }}</h3>
								</div>
							</div><!-- pop-style-dis-box -->
						</a>
					</div><!-- clo-sm-4 col-xs-12 -->
				@endforeach
			</div>
		</div>
	</div>

	<div class="container">

		<div class="row">
			<h2 class="top-buffer2 text-center hp-dest-header col-xs-12">Popular Destinations</h2>
			<p class="text-center col-xs-12">You don't know where to travel yet? Find out if you like trip plans to our popular destinations</p>

			@foreach($pop_cities as $c)
				<div class="top-buffer col-sm-4 col-xs-12">
					<a class="" href="{{'/itinerary-search?country_name=any&location='.$c->city}}">
						<div class="pop-city-dis-box" style="background-image: url('{{ env('SITE_IMAGE_PATH') . 'cities/' . strtolower($c->city) . '.jpg' }}')">

							<div>
								<h3>{{ strtoupper($c->city) }}</h3>
							</div>

						</div>
					</a>
				</div><!-- clo-sm-4 col-xs-12 -->
			@endforeach
		</div>

		<div class="row top-buffer">
			<div id="how-it-works">

				<h2 class="text-center">How It Works</h2>
				<p class="text-center">Find personalized trip plans that fit your styles</p>
				<div class="col-sm-4 col-xs-12 text-center top-buffer">
					<img alt="Personalized trip plans" src="{{ env('SITE_IMAGE_PATH') . 'how-it-works/shop.png' }}">
					<p class="hiw-img-caption">Personalized trip plans</p>
					<p class="hiw-img-desc">Define your style, and choose trip plans for any types of trips and events</p>
				</div>
				<div class="col-sm-4 col-xs-12 text-center top-buffer">
					<img alt="Easy-to-follow travel itineraries" src="{{ env('SITE_IMAGE_PATH') . 'how-it-works/check.png' }}">
					<p class="hiw-img-caption">Easy-to-follow travel itineraries</p>
					<p class="hiw-img-desc">Our easy-to-follow day-by-day trip plans make your planning easy</p>
				</div>
				<div class="col-sm-4 col-xs-12 text-center top-buffer">
					<img alt="Plan less. Travel more" src="{{ env('SITE_IMAGE_PATH') . 'how-it-works/people.png' }}">
					<p class="hiw-img-caption">Plan less. Travel more</p>
					<p class="hiw-img-desc">Benefit from experienced travellers and explore the world more.</p>
				</div>
			</div><!-- buyer info block -->
		</div>

	</div><!-- container -->

		@include('includes.home-search-mobile')


	<script>// This example displays an address form, using the autocomplete feature
		// of the Google Places API to help users fill in the information.

		var placeSearch, autocomplete;
		var componentForm = {
			locality: 'long_name',
			administrative_area_level_1: 'long_name',
			country: 'long_name'
		};

		function initAutocomplete() {
			// Create the autocomplete object, restricting the search to geographical
			// location types.
			autocomplete = new google.maps.places.Autocomplete(
					/** @type {!HTMLInputElement} */(document.getElementById('autocomplete_mobile')),
					{types: ['(cities)']});

			autocomplete = new google.maps.places.Autocomplete(
					/** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
					{types: ['(cities)']});

			// When the user selects an address from the dropdown, populate the address
			// fields in the form.
			autocomplete.addListener('place_changed', fillInAddress);

		}

		// [START region_fillform]
		function fillInAddress() {
			// Get the place details from the autocomplete object.
			var place = autocomplete.getPlace();

			for (var component in componentForm) {
				document.getElementById(component).value = '';
				document.getElementById(component).disabled = false;
			}

			// Get each component of the address from the place details
			// and fill the corresponding field on the form.
			for (var i = 0; i < place.address_components.length; i++) {
				var addressType = place.address_components[i].types[0];
				if (componentForm[addressType]) {
					var val = place.address_components[i][componentForm[addressType]];
					document.getElementById(addressType).value = val;
				}
			}


		}
		// [END region_fillform]

		// [START region_geolocation]
		// Bias the autocomplete object to the user's geographical location,
		// as supplied by the browser's 'navigator.geolocation' object.
		function geolocate() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					var geolocation = {
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};
					var circle = new google.maps.Circle({
						center: geolocation,
						radius: position.coords.accuracy
					});
					autocomplete.setBounds(circle.getBounds());
				});
			}
		}
		// [END region_geolocation]



	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&signed_in=true&libraries=places&callback=initAutocomplete"
			async defer></script>

@endsection


@section('javascript-block')


	<script  type="text/javascript">
		$(document).ready(function() {
			$('#style_list').multiselect({
				numberDisplayed: 1,
				enableCaseInsensitiveFiltering: true,
				includeSelectAllOption: true,
				maxHeight: 300,
				nonSelectedText: 'travel styles',
				allSelectedText: 'any styles',
				checkboxName: ''
			});


			//mobile style multiselect
			$('#style_list_mobile').multiselect({
				numberDisplayed: 1,
				enableCaseInsensitiveFiltering: true,
				includeSelectAllOption: true,
				maxHeight: 200,
				nonSelectedText: 'travel styles',
				allSelectedText: 'any styles',
				checkboxName: ''
			});
		});
	</script>
@stop