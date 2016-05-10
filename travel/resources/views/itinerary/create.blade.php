@extends('app', ['title' => 'Create Trip Plan - TripPlanShop'])
@section('content')


    <div class="container">

            <div class="col-xs-12"  id="itit-form">
                <h2 class="page-header">Itinerary Overview Page</h2>

                {!! Form::open(['route'=>'itinerary.store', 'class'=>'form-horizontal', 'files'=> true]) !!}
                @include('itinerary.partial_ItineraryForm')

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4 top-buffer">
                        {!! Form::submit('Create', ['class'=>'itit-btn itit-footer-button btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

    </div>


@stop