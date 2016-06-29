@extends('app')

@section('javascript-block')

@stop

@section('content')

    <!-- days container -->
    <div class="container">
        <div class="row">

            <h2 class="page-header col-xs-12">About This Day</h2>

            <!-- day images dropzone -->
            <div class="form-group">
                {!! Form::label('', 'Images for this day', ['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">

                    <form action="{{ route('itiday.storeDayImages') }}"
                          method="POST"
                          class="dropzone "
                          name = "image"
                          id="day-dropzone">

                        <input name="day_id" value="{{ $day->id }}" type="hidden">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>

                    {{-- display photos already saved for editing --}}
                    @if( !is_null($day->photos))
                        @foreach($day->photos as $photo)
                            <div class="day-photo-thumbs inline-block">
                                    <a href="{{ route('itiday.deleteDayImages', $photo->name)}}" data-day-img-delete="1">
                                        <i class="fa fa-times delete-btn" aria-hidden="true"></i>
                                    </a>
                                    <img class="thumbnail" src="/{{ $photo->photo_path }}" alt="}}">
                            </div>

                        @endforeach
                    @endif
                </div>
            </div>


        </div><!-- row -->

        <hr>
        <div class="row">
            <!-- day input form -->
            {!! Form::model($day, [
                    'data-remote',
                    'route'=>['itinerary-day.update', $day],
                    'method'=>'PATCH', 'class'=>'form-horizontal col-xs-12 ajaxForm']) !!}

            {!! Form::hidden('day_num', $day->num) !!}

            @include('itineraryDay.partial_DayForm', ['SubmitButtonText' => 'Save'])

            {!! Form::close() !!}

        </div>



        <div class="row">
            <h3 class="col-xs-12">Places to visit in this day</h3>
            <div class="iti-route bottom-buffer col-md-4 col-sm-5 col-xs-12">
                <ol class="route-list list-unstyled">
                    @foreach($day->places as $key => $place)
                    <li>
                        <a href='#day-route{{($key+1)}}'>
                            <span class="route-item">
                            <div>

                                <span class="route-letter">
                                    {!! Form::model($place, [
                                        'data-delete',
                                        'route' => ['itinerary-day.day-place.destroy',
                                        $place], 'method' => 'DELETE', 'class'=>'inline-block pull-right']) !!}


                                <button class="delete-btn like-anchor" type="submit"><i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
                                {!! Form::close() !!}{{ $place->letterLabel() }} </span>{{ ucwords($place->place_title) }}</div>
                            <span>
                                <div>
                                    @if( $place->image_path == '')
                                        <img class="place-nav-img place-{{$place->id}}"  src="{{ $place->photo_ref_google }}">
                                    @else
                                        <img class="place-nav-img place-{{$place->id}}" src="{{ asset($place->image_path) }}">
                                    @endif
                                    <div class="marker-table">
                                        <span class="route-extra"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>{{ $place->duration }}</span>
                                        <div>
                                            <span class="route-item-exp">
                                            @foreach( array_intersect_key($experiences, array_flip($place->experiences)) as $exp)
                                                <span><i class="fa fa-hashtag fa-fw" aria-hidden="true"></i>{{$exp}}</span>
                                            @endforeach
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </span>
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
            </div>
            <div class="col-md-8 col-sm-7 col-xs-12 dayPlace">

                @foreach($day->places as $key => $place)
                    <article id='day-route{{($key+1)}}' data-place-id = "{{ $place->id }}" data-place-edit = "1">

                        <div class="inner-wrap">


                            {{-- dropzone --}}
                            <form action="{{ route('itidayplace.storePlaceImage') }}"
                                  method="POST"
                                  class="dropzone"
                                  name ="place_image"
                                  id="dropzone-{{ $place->id }}">
                                <div class="fallback">
                                    <input name="place_image" type="file" multiple />
                                </div>
                                <input name="day_id" value="{{ $day->id }}" type="hidden">
                                <input name="place_id" value="{{ $place->id }}" type="hidden">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>

                            {{-- display photos already saved for editing --}}
                            @if( $place->image_path != '')
                                <div class="day-photo-thumbs inline-block">
                                    <a href="{{ route('itidayplace.deletePlaceImage', $place->id)}}" data-place-img-delete = "data-place-img-delete" data-pId = "{{ $place->id }}">
                                        <i class="fa fa-times delete-btn" aria-hidden="true"></i>
                                    </a>
                                    <img class="thumbnail" src="{{ asset($place->image_path) }}" alt="{{ $place->place_title }}}}">
                                </div>
                                <div class="clearfix"></div>
                            @endif



                            {!! Form::model($place, [
                            'route' => ['itinerary-day.day-place.update', $place->id],
                            'method' => 'PATCH',
                            'class' => "ajaxForm pid-$place->id"]) !!}


                            <!-- day google map input -->
                            @include('includes.dayPlaceMap')


                            {!! Form::label('loc_lat', null, ['class'=>'sr-only']) !!}
                            {!! Form::text('loc_lat', null, ['hidden'=>'hidden', 'id' => 'place-'.$place->id.'-lat']) !!}
                            {!! Form::label('loc_lng', null, ['class'=>'sr-only']) !!}
                            {!! Form::text('loc_lng', null, ['hidden'=>'hidden', 'id' => 'place-'.$place->id.'-lng']) !!}
                            {!! Form::label('place_address', null, ['class'=>'sr-only']) !!}
                            {!! Form::text('place_address', null, ['hidden'=>'hidden', 'id' => 'place-'.$place->id.'-formatted_address']) !!}
                            {!! Form::label('website', null, ['class'=>'sr-only']) !!}
                            {!! Form::text('website', null, ['hidden'=>'hidden', 'id' => 'place-'.$place->id.'-website']) !!}
                            {!! Form::label('photo_ref_google', null, ['class'=>'sr-only']) !!}
                            {!! Form::text('photo_ref_google', null, ['hidden'=>'hidden', 'id' => 'place-'.$place->id.'-photo_ref_google']) !!}

                            <div class="row">

                                <ul class="route-detail-table list-unstyled">
                                    <li class="col-xs-12">
                                        <div class="form-group row">
                                            {!! Form::label('place_title', 'Title', ['class'=>'control-label col-xs-4']) !!}
                                            <div class="col-xs-8">
                                                {!! Form::text('place_title', null, ['placeholder' => 'Place Title','class'=>'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xs-12">
                                        <div class="form-group row">
                                            {!! Form::label('business_hours', 'Business hours', ['class'=>'control-label col-xs-4']) !!}
                                            <div class="col-xs-8">
                                                {!! Form::textarea('business_hours', null, ['placeholder' => 'eg: mon - fri, 8am - 6am','class'=>'form-control', 'required', "maxlength"=>"20", 'data-place-id' => $place->id]) !!}
                                            </div>
                                        </div>
                                    </li>
                                    <hr class="col-xs-12">
                                    <li class="col-xs-12">
                                        <div class="form-group row">
                                            {!! Form::label('time_to_visit', 'Best time to visit', ['class'=>'control-label col-xs-4', ]) !!}
                                            <div class="col-xs-8">
                                                {!! Form::text('time_to_visit', null, ['placeholder' => 'eg: 2pm or afternoon','class'=>'form-control', 'required', "maxlength"=>"20"]) !!}
                                            </div>
                                        </div>
                                    </li>
                                    <li  class="col-xs-12">
                                        <div class="form-group row">
                                            {!! Form::label('duration', 'Duration', ['class'=>'control-label col-xs-4', ]) !!}
                                            <div class="col-xs-8">
                                                {!! Form::select('duration', $duration, null, ['placeholder' => 'eg: 3 hours','class'=>'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                    </li>
                                    <li  class="col-xs-12">
                                        <div class="form-group row">
                                            {!! Form::label('public_transit', 'Suggested transportation', ['class'=>'control-label col-xs-4', ]) !!}
                                            <div class="col-xs-8">
                                                {!! Form::select('public_transit', $transit_methods,  null, ['placeholder' => 'eg: yes/no','class'=>'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                    </li>
                                    <li  class="col-xs-12">
                                        <div class="form-group row">
                                            {!! Form::label('experiences', 'Experiences', ['class'=>'control-label col-xs-4', ]) !!}
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
                                    <button class="btn-formToggle" type="button" data-toggle="collapse" data-target="#collapseIntro-{{$place->id}}" aria-expanded="false" aria-controls="collapseExample">
                                        open/close form
                                    </button>
                                    <div class="collapse" id="collapseIntro-{{$place->id}}">
                                        {!! Form::textarea('place_intro', null,
                                        ['placeholder' => 'place introduction', 'rows'=>'5','class'=>'form-control editor', 'required', 'id' => $place->id .'place_intro']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('to_do', 'What to do(optional)', ['class'=>'control-label']) !!}
                                    <button class="btn-formToggle" type="button" data-toggle="collapse" data-target="#collapseToDo-{{$place->id}}" aria-expanded="false" aria-controls="collapseExample">
                                        open/close form
                                    </button>
                                    <div class="collapse" id="collapseToDo-{{$place->id}}">
                                        {!! Form::textarea('to_do', null,
                                        ['placeholder' => 'what to do', 'rows'=>'5','class'=>'form-control editor', 'id' => $place->id .'to_do']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('tips', 'Helpful tips(optional)', ['class'=>'control-label']) !!}
                                    <button class="btn-formToggle" type="button" data-toggle="collapse" data-target="#collapseTips-{{$place->id}}" aria-expanded="false" aria-controls="collapseExample">
                                        open/close form
                                    </button>
                                    <div class="collapse" id="collapseTips-{{$place->id}}">
                                        {!! Form::textarea('tips', null,
                                        ['placeholder' => 'Helpful tips', 'rows'=>'5','class'=>'form-control editor', 'id' => $place->id .'tips']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('transportation', 'Transportation plan(optional)', ['class'=>'control-label']) !!}
                                    <button class="btn-formToggle" type="button" data-toggle="collapse" data-target="#collapseTran-{{$place->id}}" aria-expanded="false" aria-controls="collapseExample">
                                        open/close form
                                    </button>
                                    <div class="collapse" id="collapseTran-{{$place->id}}">
                                        {!! Form::textarea('transportation', null,
                                        ['placeholder' => 'how to get to this place', 'rows'=>'5','class'=>'form-control editor', 'id' => $place->id .'transportation']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('restaurants', 'Nearby food/restaurants(optional)', ['class'=>'control-label']) !!}
                                    <button class="btn-formToggle" type="button" data-toggle="collapse" data-target="#collapseRest-{{$place->id}}" aria-expanded="false" aria-controls="collapseExample">
                                        open/close form
                                    </button>
                                    <div class="collapse" id="collapseRest-{{$place->id}}">
                                        {!! Form::textarea('restaurants', null,
                                        ['placeholder' => 'restaurants recommendation', 'rows'=>'5','class'=>'form-control editor', 'id' => $place->id .'restaurants']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('info_links', 'Info websites(optional)', ['class'=>'control-label']) !!}
                                    <button class="btn-formToggle" type="button" data-toggle="collapse" data-target="#collapseInfoLinks-{{$place->id}}" aria-expanded="false" aria-controls="collapseExample">
                                        open/close form
                                    </button>
                                    <div class="collapse" id="collapseInfoLinks-{{$place->id}}">
                                        {!! Form::textarea('info_links', null,
                                        ['placeholder' => 'links for information', 'rows'=>'5','class'=>'form-control editor', 'id' => $place->id .'info_links']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="top-buffer">
                                        {!! Form::submit('Save', ['class'=>'btn itit-footer-button btn-primary sr-only']) !!}
                                    </div>
                                </div>
                            </div>


                            {!! Form::close() !!}
                        </div>

                    </article><!-- #day -->
                @endforeach
            </div>
        </div>


        <hr>
    </div><!-- container -->
    <div class="text-center">
        <a type="button" class="btn itit-footer-button btn-primary" href="{{ route('itinerary.show', $itinerary->slug) }}">Save and Back to Itinerary</a>
    </div>
    @stop


@section('js-bottom')
    <script>
        //click to save all forms in display
        $(document).ready(function() {

            $(".ajaxForm").change(function() {

                var form = $(this);
                var method = form.find('input[name="_method"]').val() || 'POST';
                var url = form.prop('action');

                if(form[0].checkValidity()) {

                    if( form.find('textarea[class="editor"]')){
                        for( var i in CKEDITOR.instances){
                            CKEDITOR.instances[i].updateElement();
                        }
                    }

                    var $body = $("body");
                    $body.addClass("loading");


                    $.ajax({
                        type: method,
                        url: url,
                        data: form.serialize()
                    }).done(function() {

                    }).fail(function() {
                        alert('error! please try again');
                    }).always(function() {
                        $body.removeClass("loading");
                    });

                }else {
                    $("input,textarea,select").filter('[required]:visible').before( "<span style='color: red;font-size: 10px;'>required</span>");
                    alert('please fill out all required fields!');
                }
            });
        });
    </script>


    {{-- dropzone x 2--}}
    <script>
        $("#day-dropzone").dropzone({
            paramName: "image", // The name that will be used to transfer the file
            maxFilesize: 15, // MB,
            acceptedFiles: '.jpg, .jpeg, .png',
            dictDefaultMessage: 'Drop images for this day\'s gallery',
            addRemoveLinks: true,
            init: function(file) {
                this.on("queuecomplete", function() {
                    //location.reload();
                });
                this.on("removedfile", function(file) {

                    var photoNameLength = file['name'].lastIndexOf(".");
                    var photoName = file['name'].substring(0, photoNameLength);

                    $.get("/iti-day-photo-delete/" + photoName, function(){
                        //
                    }).fail(function(){
                        alert('error!');
                    });

                });
            }
        });
    </script>



    <script
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places">
    </script>
@stop


