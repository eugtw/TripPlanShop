<div class="" id="day-{{$day->day_num}}">

    <div class="itiday-box top-buffer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <span class="day-number">{!! 'DAY ' . $day->day_num !!}</span>

                    <div class="clearfix"></div>
                    @if(!$is_preview && $itinerary->user_id == Auth::user()->id && $itinerary->published == 0)
                        <div class="inline-block top-buffer bottom-buffer">
                            {!! Form::model($day,['route'=>['itinerary-day.edit', $day], 'method'=>'GET','class'=>'pull-left']) !!}
                            {!! Form::submit('Edit This Day', ['class'=>'btn btn-info']) !!}
                            {!! Form::close() !!}
                        </div>

                        <div class="inline-block top-buffer bottom-buffer">
                            {!! Form::model($day,[
                            'route'=>['itinerary-day.destroy', $day],
                            'method'=>'DELETE',
                            'class'=>'pull-left',
                            'data-delete'
                            ]) !!}
                            {!! Form::submit('Delete This Day', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                        <div class="clearfix"></div>
                    @endif
                </div>


                <h2 class="col-xs-12">{{ $day->title }}</h2>

                @include('itineraryDay.partial_swiper')

                <article class="col-xs-12  top-buffer">
                    <h3 class="">About This Day</h3>
                    <p>{!! $day->intro !!}</p>
                </article>


                <div class="top-buffer">
                    <h3 class="col-xs-12">Places to visit in this day</h3>
                    <!-- ifrom div for googleMap -->
                    <div class="bottom-buffer col-xs-12 dayMapCont">
                        <div id="day-{{$day->day_num}}-map" class="dayMap"
                             data-dayid="{{ $day->day_num }}"
                             data-places='
                            @foreach( $day->places as $p )
                            [&quot;{{$p}}&quot;@if(end($day->places) != $p ){{','}}@endif]
                            '>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- day places id="day-route"-->
                <div>
                    <div class="iti-route bottom-buffer  col-md-4 col-sm-5 col-xs-12 dayPlaceNav" >
                        <ol class="route-list list-unstyled">
                            @foreach($day->places as $key => $place)

                                <li>
                                    <a href='#day{{ $day->day_num }}-route{{($key)}}'>
                                    <span class="route-item">
                                        <div><span class="route-letter">{{ $place->letterLabel() }} </span>{{ ucwords($place->place_title) }}</div>
                                        <span>
                                            <div>
                                                @if( $place->image_path == '')
                                                    <img class="place-nav-img" src="{{ $place->photo_ref_google }}">
                                                @else
                                                    <img class="place-nav-img" src="{{ asset($place->image_path) }}">
                                                @endif

                                                <div class="marker-table">
                                                    <span class="route-extra"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>{{ $place->duration }}</span>
                                                    <div>
                                                        <span class="route-item-exp">
                                                        @foreach( array_intersect_key($experiences, array_flip($place->experiences)) as $exp)
                                                                <span><i class="fa fa-hashtag fa-fw" aria-hidden="true"></i>{{$exp}}</span>
                                                            @endforeach
                                                    </span></div>
                                                </div>
                                            </div>

                                    </span>
                                </span>
                                    </a>
                                </li>

                            @endforeach
                        </ol>
                    </div>
                    <div class=" col-md-8 col-sm-7 col-xs-12 col-xs-12 dayPlace"
                         data-dayid="{{ $day->day_num }}"
                         data-num="{{$day->places->count() }}">

                        @foreach($day->places as $key => $place)

                            <article id='day{{ $day->day_num }}-route{{($key)}}'  class="day{{$day->day_num}}"
                                     data-lat = "{{ $place->loc_lat }}"
                                     data-lng = "{{ $place->loc_lng }}"
                                     data-title = "{{ $place->place_title }}"
                                     data-address = "{{ $place->place_address }}"
                                     data-duration = "{{ $place->duration }}" >
                                <div class="clearfix"></div>
                                <div class="inner-wrap">
                                    <h3>{{ $place->place_title }}</h3>

                                    @if( $place->image_path == '')
                                        <div class="photo" style="background-image: url(' {{ $place->photo_ref_google }} ');"></div>
                                    @else
                                        <div class="photo" style="background-image: url(' {{ asset($place->image_path) }} ');"></div>
                                    @endif

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <ul class="list-unstyled summary-list">

                                                @if($place->place_address != '')
                                                    <li>
                                                        <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
                                                        <div class="name">{{ $place->place_address }}</div>
                                                    </li>
                                                @endif

                                                @if($place->website != '')
                                                    <li>
                                                        <i class="fa fa-globe fa-fw" aria-hidden="true"></i>
                                                        <div class="web-link"><a target="_blank" href="{{ $place->website }}">{{ $place->website }}</a></div>
                                                    </li>
                                                @endif

                                                @if($place->business_hours != '')
                                                    <li>
                                                        <i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>
                                                        <ul class="list-unstyled business_hours">
                                                            @foreach( explode(',', $place->business_hours) as $h)
                                                                <li class="">
                                                                    {{ $h  }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif
                                            </ul>
                                            <table class="table table-hover table-condensed bottom-buffer">
                                                <tbody>
                                                <tr>
                                                    <td>Best time to visit</td>
                                                    <td class="text-right">{{ $place->time_to_visit }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Duration</td>
                                                    <td class="text-right">{{ $place->duration }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Suggested transportation</td>
                                                    <td  class="text-right">{{ $place->public_transit }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Category</td>
                                                    <td  class="text-right">
                                                        <div class=" route-item-exp">
                                                            @foreach( array_intersect_key($experiences, array_flip($place->experiences)) as $exp)
                                                                <i class="fa fa-hashtag fa-fw" aria-hidden="true"></i>{{$exp}}
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>

                                            </table>
                                        </div>

                                    </div>


                                    <div>
                                        <p class="route-detail-title">About</p>
                                        <div>{!! $place->place_intro !!}</div>


                                        @if($place->to_do != '')
                                            <p class="route-detail-title">What to do</p>
                                            <div>{!! $place->to_do !!}</div>
                                        @endif

                                        @if($place->tips != '')
                                            <p class="route-detail-title">Tips</p>
                                            <div>{!! $place->tips !!}</div>
                                        @endif

                                        @if($place->transportation != '')
                                            <p class="route-detail-title">Transportation</p>
                                            <div>{!! $place->transportation !!}</div>
                                        @endif

                                        @if($place->restaurants != '')
                                            <p class="route-detail-title">Food nearby</p>
                                            <div>{!! $place->restaurants !!}</div>
                                        @endif

                                        @if($place->info_links != '')
                                            <p class="route-detail-title">Useful links</p>
                                            <div>{!! $place->info_links !!}</div>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>
