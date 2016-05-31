@extends('app', ['Edit Trip Plan - TripPlanShop'])

@section('javascript-block')
@stop

@section('content')


    <div class="container">
            <div class="col-xs-12"  id="itit-form">
                <h2 class="page-header">Itinerary Overview Page</h2>


                {{-- dropzone --}}
                <div class="form-group">

                    {!! Form::label('', 'Cover Image: ', ['class'=>'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        <form action="{{ route('itinerary.storeCoverImage') }}"
                              method="POST"
                              class="dropzone"
                              name = "iti_image"
                              id="iti-photo-dropzone">

                            <input name="iti_slug" value="{{ $itinerary->slug }}" type="hidden">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>

                {{--show iti. cover img to remind poster if they want to change it! --}}
                <div class="form-group">
                    {!! Form::label('', 'Current Cover Image: ', ['class'=>'col-sm-3 control-label']) !!}
                    <div class="iti-photo-thumbs inline-block col-xs-12">
                        <img class="thumbnail" src="{{ asset($itinerary->image_path) }}" alt="}}">
                    </div>
                </div>

                <div class="clearfix"></div>
                <hr class="col-xs-12">


                {{-- form model binding for form update--}}
                {!! Form::model($itinerary,['route'=>['itinerary.update',$itinerary->slug], 'method'=>'PATCH','class'=>'form-horizontal', 'files'=>true]) !!}

                @include('itinerary.partial_ItineraryForm')


                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4 top-buffer">
                       {!! Form::submit('Update', ['class'=>'itit-btn itit-footer-button btn-primary']) !!}
                    </div>
                </div>

                <script>
                    $('form').submit(function( ){
                        $('#city_list option').prop('selected', true);
                    });
                </script>
                {!! Form::close() !!}
            </div>
    </div>



    {{-- dropzone --}}
    <script>
        Dropzone.options.itiPhotoDropzone = {
            dictDefaultMessage: 'Click to upload new cover image',
            paramName: "iti_image", // The name that will be used to transfer the file
            maxFilesize: 99, // MB
            acceptedFiles: '.jpg, .jpeg, .png',
            maxFiles: 1,
            init: function(file) {
                this.on("queuecomplete", function() {
                    location.reload();
                });
            }
        };
    </script>
@stop