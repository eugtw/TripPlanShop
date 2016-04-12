@extends('app')

@section('content')
    <!-- days container -->
    <div class="container">
            <div class="col-xs-12"  id="itit-form"">
                <h2 class="page-header">About This Day</h2>
                {!! Form::model($day, ['route'=>['itinerary-day.update', $day], 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
                    {!! Form::hidden('day_of_itinerary', $day->day_of_itinerary) !!}
                    @include('itineraryDay.partial_DayForm', ['SubmitButtonText' => 'Update'])

                {!! Form::close() !!}
            </div>
    </div>
@stop

