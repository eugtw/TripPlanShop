@extends('app', ['title'=>((isset($selected_location) && $selected_location != '') ? $selected_location :'Popular ') . ' trip plans - TripPlanShop'])

@section('content')
    <div class="text-center">
        <a class="" id="sr-searchbar-mobile" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-search"></i> Find Itineraries</a>


        <div id="sr-searchbar-container">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        {!! Form::open(['url'=>'itinerary-search','method'=>'GET','id'=>'sr-searchbar']) !!}

                        {!! Form::label('style_list', 'Style Select',['hidden'=>'true']) !!}
                        {!! Form::select('style_list[]', $travelStyles, (isset($selected_styles) && $selected_styles == '') ? $selected_styles : 5,['id'=>'style_list', 'class'=>'style_list', 'multiple' => 'multiple']) !!}

                        {!! Form::text('location', (isset($selected_location) && $selected_location != '' ) ? $selected_location : null,['placeholder'=>'any city','id' => 'autocomplete', 'onFocus'=>'geolocate()']) !!}


                        {!! Form::label('country_name', 'Country Select',['hidden'=>'true']) !!}
                        {!! Form::select('country_name', (['any'=>'any country'] +$travelCountries), (isset($selected_country) && $selected_country != 'any') ? $selected_country : 1) !!}


                        {!! Form::submit('SEARCH', ['class'=>'', 'id'=>'iti-search-btn']) !!}

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div><!-- #header-searchbar-container -->
    </div>

    <div class="container ">
        <div id="search-result">
            @if((isset($selected_country) && $selected_country != 'any')||
                    (isset($selected_location) && $selected_location != '' ) ||
                        ( isset($selected_styles) && $selected_styles != '' ) )
                <div class="row">
                    @if(!$itineraries->isEmpty())
                        <h1 class="page-header col-xs-12">Search results</h1>
                        @foreach($itineraries as $key => $itinerary)
                            <div class="col-md-4 col-sm-6 col-xs-12 iti_card bottom-buffer">
                                @include('itinerary.partial_ItineraryDisplay', ['is_preview'=>1, 'key'=>$key])
                            </div>
                        @endforeach
                    @else
                        <h1 class="page-header col-xs-12">No results</h1>
                        <p class="col-xs-12">Try something else or check out recently published itineraries.</p>
                    @endif
                </div>

                <hr class="search-page-hr">
            @elseif(isset($pop_iti_search) && $pop_iti_search == 1)
                <div class="row">
                    @if(!$itineraries->isEmpty())
                        <h1 class="page-header col-xs-12">Popular trip plans</h1>
                        @foreach($itineraries as $key => $itinerary)
                            <div class="col-md-4 col-sm-6 col-xs-12 iti_card bottom-buffer">

                                @include('itinerary.partial_ItineraryDisplay', ['is_preview'=>1, 'key'=>$key])

                            </div>
                        @endforeach
                    @else
                        <h1 class="page-header col-xs-12">No results.</h1>
                    @endif
                </div>

                <hr class="search-page-hr">
            @endif

            <div class="row">
                <h2 class="page-header col-xs-12">Recently published</h2>
                @foreach($recentItineraries as $key => $itinerary)
                    <div class="col-md-4 col-sm-6 col-xs-12 iti_card bottom-buffer">
                        @include('itinerary.partial_ItineraryDisplay', ['is_preview'=>1, 'key'=>$key])
                    </div>
                @endforeach

                <div class="clearfix"></div>
                <div class="text-center">
                    {!! $recentItineraries->appends(Request::except('page'))->render() !!}
                </div>
            </div>
        </div>

    </div>

    @include('includes.home-search-mobile')

    <script>
        jQuery(function(){
            $('.iti_card').matchHeight();
        });
    </script>
    <script>
        // This example displays an address form, using the autocomplete feature
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

@stop


@section('javascript-block')
    <script  type="text/javascript">
        $(document).ready(function() {
            $('#style_list').multiselect({
                numberDisplayed: 1,
                enableCaseInsensitiveFiltering: true,
                includeSelectAllOption: true,
                maxHeight: 300,
                nonSelectedText: 'any travel styles',
                allSelectedText: 'any styles',
                checkboxName: ''
            });

            var all_styles = new Array();
            var sel_styles = new Array();

            <?php foreach($travelStyles as $key => $val){ ?>
            all_styles.push('<?php echo $val; ?>');
            <?php } ?>
            <?php foreach($selected_styles as $key => $val){ ?>
            sel_styles.push('<?php echo $val; ?>');
            <?php } ?>

            var opts = [];
            for(var i = 0; i < all_styles.length; i++)
            {
                if( sel_styles.indexOf(all_styles[i]) == -1 )
                {
                    opts[i] = {label: all_styles[i], title: all_styles[i], value: all_styles[i]};
                }else{
                    opts[i] = {label: all_styles[i], title: all_styles[i], value: all_styles[i], selected: true};
                }

            }
            $('#style_list').multiselect('dataprovider', opts);




            //mobile style multiselect
            $('#style_list_mobile').multiselect({
                numberDisplayed: 1,
                enableCaseInsensitiveFiltering: true,
                includeSelectAllOption: true,
                maxHeight: 200,
                nonSelectedText: 'any travel styles',
                allSelectedText: 'any styles',
                checkboxName: ''
            });
        });
    </script>
@stop