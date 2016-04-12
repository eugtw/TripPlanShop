@extends('app')

@section('content')
    <!-- days container -->
    <div class="container">
            <div class="col-xs-12"  id="itit-form"">
                <h2 class="page-header">About This Day</h2>

                {!! Form::open(['route'=>'itinerary-day.store', 'class'=>'form-horizontal']) !!}
                    {!! Form::hidden('iti_id', Crypt::encrypt($itinerary->id)) !!}
                    @include('itineraryDay.partial_DayForm', ['SubmitButtonText' => 'Save'])

                {!! Form::close() !!}
            </div>
    </div>
@stop

