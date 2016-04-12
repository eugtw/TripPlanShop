@extends('app', ['Edit Trip Plan - TripPlanShop'])
@section('content')


    <div class="container">
            <div class="col-xs-12"  id="itit-form">
                <h2 class="page-header">Itinerary Overview Page</h2>
                {{-- form model binding for form update--}}
                {!! Form::model($itinerary,['route'=>['itinerary.update',$itinerary], 'method'=>'PATCH','class'=>'form-horizontal', 'files'=>true]) !!}

                @include('itinerary.partial_ItineraryForm')


                {{--show iti. cover img to remind poster if they want to change it! --}}
                <div class="form-group">
                    {!! Form::label('image', 'Current Cover Image: ', ['class'=>'col-sm-3 control-label']) !!}
                    <div class="col-sm-5">
                    <img class="img-responsive" src="{{env('IMAGE_ROOT') . $itinerary->image}}">
                    </div>
                </div>

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


@stop