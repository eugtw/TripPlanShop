@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-xs-12 screen-height top-buffer" id="pub-list-container">
                <h2 class="page-header">Published Trip Plans</h2>

                @foreach($itineraries as $itinerary)
                        <div class="pub-list table">
                        <span class="pub-list-cell">
                            @if($itinerary->published == env("ITI_PUBLISHED"))
                                <a type="button" class="" href="{{route('itinerary.unpublish',[$itinerary])}}">
                                    Unpublish
                                </a>
                            @endif
                        </span>
                        <span class="thumb pub-list-cell">
                            <img class="" src="/{{ $itinerary->image_path }}">
                        </span>

                        <span class="iti-pub-detail pub-list-cell">
                                <div><a href="{{ route('itinerary.show', $itinerary) }}">{{ $itinerary->title }}</a></div>
                                <div>
                                    <a class="iti_sales" href="{{ route('itinerary.getSalesDetails', $itinerary) }}">
                                        <span>{{ 'sales: ' . $itinerary->transactions()->count() }}</span>
                                    </a>
                                    @if(count($itinerary->unreadSales()) > 0)
                                        <span class="iti_new_sales"><i>{{ count($itinerary->unreadSales()) . ' new' }}</i></span>
                                    @endif
                                </div>

                                <div>
                                    <span class="iti_view_list_time">Published: {{ $itinerary->created_at->format("Y-M-d") . ' / ' }}</span>
                                    <span class="iti_view_list_time">Last edited: {{ $itinerary->updated_at->format("Y-M-d") }}</span>
                                </div>
                        </span>

                            <div class="clearfix"></div>
                        </div><!-- iti_view_list_box -->

                @endforeach

                <div class="clearfix"></div>
                <div class="text-center ">
                    {!! $itineraries->render() !!}
                </div>
            </div>
        </div>

    </div><!-- container -->

@stop