@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-xs-12 screen-height top-buffer" id="iti_view_list_container">
                <h2 class="page-header">Published Trip Plans</h2>

                @foreach($itineraries as $itinerary)
                    <div class="iti_view_list_box">

                        <div class="iti_view_list_img pull-left">
                            <img class="" src="{{ env('IMAGE_ROOT') . $itinerary->image }}">
                        </div>

                        <div class="iti_view_list_detail pull-left">
                            <div class="pull-left">
                                <p><a href="{{ route('itinerary.show', $itinerary) }}">{{ $itinerary->title }}</a></p>

                                <p>
                                    <a class="iti_sales" href="{{ route('itinerary.getSalesDetails', $itinerary) }}">
                                        <span>{{ 'sales: ' . $itinerary->transactions()->count() }}</span>
                                    </a>
                                    @if(count($itinerary->unreadSales()) > 0)
                                        <span class="iti_new_sales"><i>{{ count($itinerary->unreadSales()) . ' new' }}</i></span>
                                    @endif
                                </p>

                                <p>
                                    <span class="iti_view_list_time">Published: </span>{{ $itinerary->created_at->format("Y-M-d") . ' / ' }}
                                    <span class="iti_view_list_time">Last edited: </span>{{ $itinerary->updated_at->format("Y-M-d") }}
                                </p>
                            </div>

                            <div class="pull-left iti_view_list_time">
                                <p>

                                </p>
                            </div>
                        </div>

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