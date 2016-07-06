@extends('app')

@section('content')
    <!-- days container -->
    <div class="container">
            <div class="col-xs-12"  id="itit-form">
                <h2 class="page-header">About This Day</h2>

                {!! Form::open(['route'=>'itinerary-day.store', 'class'=>'form-horizontal']) !!}
                    {!! Form::hidden('iti_id', Crypt::encrypt($itinerary->id)) !!}
                    @include('itineraryDay.partial_DayForm')

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9 top-buffer">
                        {!! Form::submit('Save', ['class'=>'btn itit-footer-button btn-primary']) !!}
                    </div>

                </div>
                {!! Form::close() !!}

            </div>
    </div>
@stop

