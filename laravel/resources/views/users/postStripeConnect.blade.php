@extends('app')
@section('content')
    <div class="container screen-height">
        <div class="row">
            <h3 class="page-header">You Are Now Ready to Create and Sell Itineraries</h3>
            <a href="{{ route('itinerary.create') }}">Create Your First Itinerary</a>
        </div>
    </div>
@stop