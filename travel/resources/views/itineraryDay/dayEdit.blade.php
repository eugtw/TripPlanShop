@extends('app')

@section('javascript-block')
    {{-- select2 --}}
    <script src="/js/select2/select2.min.js"></script>
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
                    'method'=>'PATCH', 'class'=>'form-horizontal'
            ]) !!}
            {!! Form::hidden('day_num', $day->num) !!}
            @include('itineraryDay.partial_DayForm', ['SubmitButtonText' => 'Save Changes'])

            {!! Form::close() !!}

        </div>



        <div class="row" id="day-route">
            <div class="iti-route col-xs-12 ">
                <div class="row">
                    <h3 class="col-xs-12">Places to visit in this day</h3>
                    <ol class="route-list route-day{{ $day->day_num }} col-md-4 col-xs-12 list-unstyled">
                        @foreach($day->places as $key => $place)

                        <li>
                                {!! Form::model($place, ['data-delete',
                                                            'route' => ['itinerary-day.day-place.destroy',
                                                            $place], 'method' => 'DELETE']) !!}
                                <button class="delete-btn like-anchor" type="submit"><i class="fa fa-times" aria-hidden="true"></i></button>
                                {!! Form::close() !!}
                                <a href='#day-route{{($key+1)}}'>
                                    <span class="route-letter">{{($key+1)}} </span>
                                    <span class="route-item">
                                        {{ $place->place_title }}
                                        <div>
                                            <span class="route-extra"><i class="fa fa-map-marker" aria-hidden="true"></i>St. John's</span>
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
                        <div id='day-route{{($key+1)}}'>

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
                                <a href="{{ route('itidayplace.deletePlaceImage', $place->id)}}" class="">
                                    <i class="fa fa-times delete-btn" aria-hidden="true"></i>
                                </a>
                                <img class="thumbnail" src="/{{ $place->image_path }}" alt="}}">
                            </div>

                            @endif


                            {!! Form::model($place, ['data-remote',
                            'route' => ['itinerary-day.day-place.update', $place->id],
                            'method' => 'PATCH'
                            ]) !!}
                            <div class="form-group top-buffer">
                                {!! Form::label('place_title', 'Title', ['class'=>'control-label']) !!}
                                <div class="">
                                    {!! Form::text('place_title', null, ['placeholder' => 'Place Title','class'=>'form-control', 'required']) !!}
                                </div>
                            </div>
                            <p class="place-extra">St. John's</p>

                            <div class="row">

                                <ul class="route-detail-table list-unstyled col-xs-12">
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
                                                ['multiple' => 'multiple', 'placeholder' => 'category','class'=>'form-control', 'id' => "exp_place_$key" , 'required']) !!}
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <script>
                                    $('#exp_place_{{$key}}').select2({
                                        maximumSelectionLength: '{{ env('MAX_STYLE_TAG') }}',
                                        tags: true
                                    });

                                </script>
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
                                    <div class="top-buffer text-center">
                                        {!! Form::submit('Save Changes', ['class'=>'btn itit-footer-button btn-primary']) !!}
                                        <a type="button" class="btn itit-footer-button btn-primary" href="{{ route('itinerary.show', $itinerary) }}">Back to Overview</a>
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


@section('javascriptfooter5')
    {{-- jquery tabs --}}
    <script>
        $("ol.route-day{{ $day->day_num }}").each(function(){
            // For each set of tabs, we want to keep track of
            // which tab is active and its associated content
            var $active, $content, $links = $(this).find('a');

            // If the location.hash matches one of the links, use that as the active tab.
            // If no match is found, use the first link as the initial active tab.
            $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
            $active.addClass('active');

            $content = $($active[0].hash);

            // Hide the remaining content
            $links.not($active).each(function () {
                $(this.hash).hide();
            });

            // Bind the click event handler
            $(this).on('click', 'a', function(e){
                // Make the old tab inactive.
                $active.removeClass('active');
                $content.hide();

                // Update the variables with the new link and content
                $active = $(this);
                $content = $(this.hash);

                // Make the tab active.
                $active.addClass('active');
                $content.show();

                // Prevent the anchor's default click action
                e.preventDefault();
            });
        });
    </script>


    {{-- dropzone x 2--}}
    <script>
        Dropzone.options.dayPhotosDropzone = {
            paramName: "image", // The name that will be used to transfer the file
            maxFilesize: 15, // MB
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



@stop