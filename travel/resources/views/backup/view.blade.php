@extends('app', ['title' => $itinerary->title . ': Travel Itinerary On TripPlanShop'])

@section('meta-og')
    <meta property="og:url"                content="{{ route('itinerary.show',$itinerary) }}">
    <meta property="og:type"               content="article">
    <meta property="og:title"              content="{{ $itinerary->title }}">
    <meta property="og:description"        content="{{ $itinerary->summary }}">
    <meta property="og:image"              content="http://tripplanshop.com{{ preg_replace('/ /', '%20', env('IMAGE_ROOT') . $itinerary->image)   }}">
    <meta property="og:site_name" content="TripPlanShop"/>
    <meta property="fb:app_id"             content="{{ env('FB_CLIENT_ID') }}"
@stop

@section('content')
        <div class="container itit-container">

            @if(Auth::check() && $itinerary->user_id == Auth::user()->id)
                {{--- is user the author? and itinerary not published? If so, show edit button ---}}
                @if(!$is_preview && $itinerary->published == env("ITI_NOT_PUBLISHED") )
                    <div class="inline-block">
                        {!! Form::open(['route'=>['itinerary.edit', $itinerary], 'method'=>'get']) !!}

                        {!! Form::submit('Edit Overview', ['class'=>'btn btn-info']) !!}
                        {!! Form::close() !!}
                    </div>
                @endif


                @if($itinerary->published == env("ITI_PUBLISHED"))
                    <a type="button" class="btn btn-info text-center" href="{{route('itinerary.unpublish',[$itinerary])}}">
                        Unpublish and Edit
                    </a>
                @else
                    {{-- cannot publich if iti doesnt have even 1 day details--}}
                    @if($itinerary->days->count() >= 1)
                        <a type="button" class="btn btn-info text-center" href="{{route('itinerary.publish',[$itinerary])}}">
                            Publish
                        </a>
                        <a type="button" class="btn btn-info text-center" href="{{route('user.show', [Auth::user()])}}">
                            Save
                        </a>
                    @endif
                @endif
            @endif

            @include('delete.partial_ItineraryView')


            <hr class="top-buffer">
            <div class="text-center top-buffer">

                @if($is_preview)
                    @if($itinerary->price == 0)
                        <a type="button" class="itit-button itit-footer-button btn-primary" href="{{ route('itinerary.getItitFree', $itinerary) }}">Get This</a>
                    @else
                        <a type="button" class="itit-button itit-footer-button btn-primary" href="{{ route('itinerary.purchaseConfirm', $itinerary) }}">BUY FULL ITINERARY</a>
                    @endif
                @elseif($itinerary->user_id == Auth::user()->id)
                    @if($itinerary->published != env("ITI_PUBLISHED"))
                        {{--- not published yet? show "add more days" button" and "publish" button ---}}
                        <div class="day-create-container text-center">
                            {!! Form::open(['route'=>'itinerary-day.create','method'=>'GET']) !!}
                            {!! Form::hidden('iti_id', Crypt::encrypt($itinerary->id)) !!}
                            {!! Form::submit('Add Day', ['class'=>'pv-footer-button btn-info']) !!}
                            {!! Form::close() !!}
                        </div>
                    @endif
                    <div class="top-buffer">
                        @if($itinerary->published == env("ITI_PUBLISHED"))
                            <a type="button" class="btn btn-primary text-center" href="{{route('itinerary.unpublish',[$itinerary])}}">
                                Unpublish Itinerary
                            </a>
                        @else
                            {{-- cannot publich if iti doesnt have even 1 day details--}}
                            @if($itinerary->days->count() >= 1)
                                <a type="button" class="itit-footer-button itit-btn btn-primary text-center top-buffer" href="{{route('itinerary.publish',[$itinerary])}}">
                                    Publish Itinerary
                                </a>
                                <a type="button" class="itit-footer-button itit-btn btn-primary text-center top-buffer" href="{{route('user.show', [Auth::user()])}}">
                                    Save
                                </a>
                            @endif
                        @endif
                    </div>
                @else
                    <a type="button" class="itit-footer-button itit-btn btn-primary" href="#" data-toggle="modal" data-target="#reviewModal_{{ $itinerary->getRouteKey() }}">Rate this itinerary</a>
                @endif
            </div>
        </div>


    @include('itinerary.review_modal')
@endsection
