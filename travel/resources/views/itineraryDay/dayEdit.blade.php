@extends('app')

@section('javascript-block')

@stop

@section('content')


    <!-- days container -->
    <div class="container">
        <div class="row">
            <h2 class="page-header">About This Day</h2>

            <!-- day images dropzone -->
            <div class="form-group">
                {!! Form::label('', 'Images for this day', ['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">

                    <form action="{{ route('itiday.storeDayImages') }}"
                          method="POST"
                          class="dropzone "
                          name = "image"
                          id="day-photos-dropzone">

                        <input name="day_id" value="{{ $day->id }}" type="hidden">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>

                    {{-- display photos already saved for editing --}}
                    @if( !is_null($day->photos))
                        @foreach($day->photos as $photo)
                            <div class="day-photo-thumbs inline-block">
                                <a href="{{ route('itiday.deleteDayImages', $photo->id)}}" class="">
                                    <i class="fa fa-times delete-btn" aria-hidden="true"></i>
                                </a>
                                <img class="thumbnail" src="/{{ $photo->photo_path }}" alt="}}">
                            </div>

                        @endforeach
                    @endif
            </div>
        </div><!-- row -->
        </div>

        <hr class="col-xs-12">

        <div class="row">
            <!-- day input form -->
            {!! Form::model($day, [
                    'data-remote',
                    'route'=>['itinerary-day.update', $day],
                    'method'=>'PATCH', 'class'=>'form-horizontal']) !!}

            {!! Form::hidden('day_num', $day->num) !!}

            @include('itineraryDay.partial_DayForm', ['SubmitButtonText' => 'Save Changes'])

            {!! Form::close() !!}

        </div>



        <div class="row" id="day-route">
            <div class="iti-route col-xs-12 ">
                <div class="row">
                    <h3 class="col-xs-12">Places to visit in this day</h3>
                    <ol class="route-list col-md-4 col-xs-12 list-unstyled">
                        @foreach($day->places as $key => $place)

                        <li>
                            {!! Form::model($place, [
                                'data-delete',
                                'route' => ['itinerary-day.day-place.destroy',
                                $place], 'method' => 'DELETE']) !!}

                                <button class="delete-btn like-anchor" type="submit"><i class="fa fa-times" aria-hidden="true"></i></button>
                            {!! Form::close() !!}

                            <a href='#day-route{{($key+1)}}'>
                                <span class="route-letter">{{($key+1)}} </span>
                                <span class="route-item">
                                    {{ $place->place_title }}

                                    <div class="marker-table">
                                        <span class="route-extra mark"><i class="fa fa-map-marker" aria-hidden="true"></i></span><span  class="route-extra detail">{{ $place->place_name_short }}</span>
                                    </div>

                                    <div>

                                        <span class="route-extra"><i class="fa fa-clock-o" aria-hidden="true"></i>{{ $place->duration }}</span>
                                        <span class="route-extra"><i class="fa fa-usd" aria-hidden="true"></i>{{ $place->price_range }}</span>
                                    </div>
                                    <div>
                                        @foreach( array_intersect_key($experiences, array_flip($place->experiences)) as $exp)
                                        <span class="route-item-exp">{{$exp}}</span>
                                        @endforeach
                                    </div>
                                </span>
                            </a>
                        </li>

                        @endforeach

                        <li>
                            {!! Form::open(['data-remote', 'route' => 'itinerary-day.day-place.store', 'method' => 'POST']) !!}
                            {!! Form::text('day_id', $day->id, ['hidden' => 'hidden']) !!}

                            <button class="route-add" type="submit">Add new place</button>

                            {!! Form::close() !!}

                        </li>
                    </ol>

                    <div class="col-md-8 col-xs-12">
                    @foreach($day->places as $key => $place)
                        <div id='day-route{{($key+1)}}' data-place-id = {{ $place->id }}>

                            {{-- dropzone --}}
                            <form action="{{ route('itidayplace.storePlaceImage') }}"
                                  method="POST"
                                  class="dropzone"
                                  name = "place_image"
                                  id="place-photo-dropzone">

                                <input name="day_id" value="{{ $day->id }}" type="hidden">
                                <input name="place_id" value="{{ $place->id }}" type="hidden">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>

                            {{-- display photos already saved for editing --}}
                            @if( $place->image_path != '')
                            <div class="day-photo-thumbs inline-block">
                                <a href="{{ route('itidayplace.deletePlaceImage', $place->id)}}" >
                                    <i class="fa fa-times delete-btn" aria-hidden="true"></i>
                                </a>
                                <img class="thumbnail" src="/{{ $place->image_path }}" alt="}}">
                            </div>

                            @endif


                            {!! Form::model($place, [   'data-remote',
                                                        'route' => ['itinerary-day.day-place.update', $place->id],
                                                        'method' => 'PATCH']) !!}


                            <!-- day google map input -->
                            @include('includes.dayPlaceMap')


                            {!! Form::label('loc_lat', null, ['class'=>'sr-only']) !!}
                            {!! Form::text('loc_lat', null, ['hidden'=>'hidden', 'id' => 'place-'.$place->id.'-lat']) !!}
                            {!! Form::label('loc_lng', null, ['class'=>'sr-only']) !!}
                            {!! Form::text('loc_lng', null, ['hidden'=>'hidden', 'id' => 'place-'.$place->id.'-lng']) !!}
                            {!! Form::label('place_name_short', null, ['class'=>'sr-only']) !!}
                            {!! Form::text('place_name_short', null, ['hidden'=>'hidden', 'id' => 'place-'.$place->id.'-name-short']) !!}

                            <div class="form-group top-buffer">
                                {!! Form::label('place_title', 'Title', ['class'=>'control-label']) !!}
                                <div class="">
                                    {!! Form::text('place_title', null, ['placeholder' => 'Place Title','class'=>'form-control', 'required']) !!}
                                </div>
                            </div>


                            <div class="row">

                                <ul class="route-detail-table list-unstyled col-xs-12">
                                    <li>
                                        <div class="form-group top-buffer">
                                            {!! Form::label('place_name_long', 'Place Name', ['class'=>'control-label col-xs-4']) !!}
                                            <div class="col-xs-8">
                                                {!! Form::text('place_name_long', null, ['placeholder' => 'Place name','class'=>'form-control', 'id' => 'place-'.$place->id.'-name-long', 'required']) !!}
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            {!! Form::label('time_to_visit', 'time to visit', ['class'=>'control-label col-xs-4', ]) !!}
                                            <div class="col-xs-8">
                                                {!! Form::text('time_to_visit', null, ['placeholder' => 'eg: 2pm','class'=>'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            {!! Form::label('business_hours', 'business hours', ['class'=>'control-label col-xs-4', ]) !!}
                                            <div class="col-xs-8">
                                                {!! Form::text('business_hours', null, ['placeholder' => 'eg: mon - fri, 8am - 6am','class'=>'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            {!! Form::label('duration', 'duration', ['class'=>'control-label col-xs-4', ]) !!}
                                            <div class="col-xs-8">
                                                {!! Form::text('duration', null, ['placeholder' => 'eg: 3 hours','class'=>'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            {!! Form::label('price_range', ' price range(US)', ['class'=>'control-label col-xs-4', ]) !!}
                                            <div class="col-xs-8">
                                                {!! Form::number('price_range', null, ['placeholder' => 'eg: 75','class'=>'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            {!! Form::label('transportation', 'transportation required', ['class'=>'control-label col-xs-4', ]) !!}
                                            <div class="col-xs-8">
                                                {!! Form::text('transportation', null, ['placeholder' => 'eg: car','class'=>'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                    </li>
                                    <div class="clearfix"></div>
                                    <li>
                                        <div class="form-group">
                                            {!! Form::label('experiences', 'experiences', ['class'=>'control-label col-xs-4', ]) !!}
                                            <div class="col-xs-8">

                                                {!! Form::select('experiences[]', $experiences, null,
                                                ['multiple' => 'multiple', 'placeholder' => 'category','class'=>'form-control select2', 'id' => "exp_place_$key" , 'data-max-selected' => '2', 'required']) !!}
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                            </div>


                            <div>
                                <div class="form-group">
                                    {!! Form::label('place_intro', 'Intro', ['class'=>'control-label']) !!}
                                    <div class="">
                                        {!! Form::textarea('place_intro', null,
                                        ['placeholder' => 'place introduction', 'rows'=>'5','class'=>'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('to_do', 'What to do', ['class'=>'control-label']) !!}
                                    <div class="">
                                        {!! Form::textarea('to_do', null,
                                        ['placeholder' => 'what to do', 'rows'=>'5','class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('to_eat', 'What to eat', ['class'=>'control-label']) !!}
                                    <div class="">
                                        {!! Form::textarea('to_eat', null,
                                        ['placeholder' => 'what to eat', 'rows'=>'5','class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('tips', 'Helpful tips', ['class'=>'control-label']) !!}
                                    <div class="">
                                        {!! Form::textarea('tips', null,
                                        ['placeholder' => 'Helpful tips', 'rows'=>'5','class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="top-buffer">
                                        {!! Form::submit('Save Changes', ['class'=>'btn itit-footer-button btn-primary']) !!}
                                        <a type="button" class="btn itit-footer-button btn-primary" href="{{ route('itinerary.show', $itinerary->slug) }}">Back to Overview</a>
                                    </div>
                                </div>
                            </div>


                            {!! Form::close() !!}
                        </div><!-- #day -->
                    @endforeach
                    </div>
                </div><!-- row -->
            </div>
        </div><!-- row -->
        <hr class="col-xs-12">
    </div><!-- container -->
@stop


@section('js-bottom')

    {{-- dropzone x 2--}}
    <script>
        Dropzone.options.dayPhotosDropzone = {
            paramName: "image", // The name that will be used to transfer the file
            maxFilesize: 15, // MB,
            acceptedFiles: '.jpg, .jpeg, .png',
            //addRemoveLinks: true,
            init: function(file) {
                this.on("queuecomplete", function() {
                    location.reload();
                });
            }
        };
    </script>

    <script>
        Dropzone.options.placePhotoDropzone = {
            maxFiles: 1,
            paramName: "place_image", // The name that will be used to transfer the file
            maxFilesize: 15, // MB
            acceptedFiles: '.jpg, .jpeg, .png',
            init: function() {
                this.on("queuecomplete", function() {
                    location.reload();
                });
            }
        };
    </script>



    {{-- map  --}}
    <script>
        var maps = [];
        var markers = [];
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name'
            //administrative_area_level_1: 'short_name',
            //country: 'long_name',
            //postal_code: 'short_name'
        };

        function setMaps(){
            $('div.placeMap').each( function() {

                var pId = $(this).data('placeId');
               setEachGoogleMap(pId);
            });
        }

        function setEachGoogleMap(pId){
            var default_location = {lat: 59.327, lng: 18.067};
            var LngLat = default_location;
            var loc_lat = $('#place-' + pId + '-lat').val();
            var loc_lng = $('#place-' + pId + '-lng').val();

            if(loc_lat != '' && loc_lng != '')
            {
                LngLat = new google.maps.LatLng(loc_lat, loc_lng);
            }

            var geocoder = new google.maps.Geocoder();

            maps[pId] = initMap(pId, LngLat, geocoder);

            if(loc_lat != '' && loc_lng != '')
            {
                markers[pId] = new google.maps.Marker({
                    animation: google.maps.Animation.DROP,
                    position: LngLat,
                    map: maps[pId],
                    draggable: true
                });

                google.maps.event.addListener(markers[pId], 'dragend', function() {
                    //updateMarkerStatus('Drag ended');
                    geoPosition(markers[pId].getPosition(), geocoder, pId);
                });

            }
        }

        function initMap(pId, center, geocoder){
            var newMap = new google.maps.Map(document.getElementById('place-' + pId + '-Map'), {
                zoom: 13,
                scrollwheel: true,
                scaleControl: true,
                center: center

            });
            var input = /** @type {!HTMLInputElement} */(
                    document.getElementById('place-' + pId + '-address'));
            console.log(input);
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', newMap);
            var infowindow = new google.maps.InfoWindow();
            autocomplete.addListener('place_changed', function() {
                infowindow.close();

            });

            document.getElementById('place-' + pId + '-submit').addEventListener('click', function () {
                geoAddress(geocoder, newMap, pId);
            });
           return newMap;
        }

        function geoPosition(pos, geocoder, placeId) {
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                if (responses && responses.length > 0) {
                    updateInputs(placeId, responses);

                } else {
                    // updateMarkerAddress('Cannot determine address at this location.');
                }
            });
        }

        function geoAddress(geocoder, resultsMap, placeId) {
            var address = document.getElementById('place-'+placeId+'-address').value;
            geocoder.geocode({'address': address}, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {

                    placeMarker(results[0].geometry.location, resultsMap, placeId, geocoder);
                    updateInputs(placeId, results);

                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }

        function placeMarker(location, map, placeId, geocoder) {
            if ( markers[placeId] ) {
                //if marker already was created change positon
                markers[placeId].setPosition(location);
            } else {
                //create a marker
                markers[placeId] = new google.maps.Marker({
                    position: location,
                    map: map,
                    draggable: true
                });

                google.maps.event.addListener(markers[placeId], 'dragend', function() {
                    //updateMarkerStatus('Drag ended');
                    geoPosition(markers[placeId].getPosition(), geocoder, placeId);
                });
            }
            map.setCenter(markers[placeId].getPosition());
        }

        function updateInputs(placeId, responses){
            var address_short = '';

            for( var i = 0; i < responses[0].address_components.length; i++) {
                var addressType = responses[0].address_components[i].types[0];
                if( componentForm[addressType]) {
                    if( i == 0){
                        address_short = responses[0].address_components[i][componentForm[addressType]]
                    }else{
                        address_short = address_short + ' ' + responses[0].address_components[i][componentForm[addressType]];
                    }
                }
            }
            $('#place-' + placeId + '-address').val(responses[0].formatted_address);
            $('#place-' + placeId + '-lat').val(responses[0].geometry.location.lat());
            $('#place-' + placeId + '-lng').val(responses[0].geometry.location.lng());
            $('#place-' + placeId + '-name-short').val(address_short);
            $('#place-' + placeId + '-name-long').val(responses[0].formatted_address);

            //alert(address_short);
        }

    </script>
    <script
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places&callback=setMaps">
    </script>

@stop