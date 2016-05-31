<div class="" id="day-{{$day->day_num}}">
    <div class="row">

        <div class="itiday-box top-buffer">

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
                <div class="iti-route col-md-4 col-sm-5 col-xs-12">
                    <ol class="route-list list-unstyled">
                        @foreach($day->places as $key => $place)

                            <li>
                                <a href='#day{{ $day->day_num }}-route{{($key)}}'>
                                        <span class="route-item">
                                            <div><span class="route-letter">{{ $place->letterLabel() }} </span>{{ ucwords($place->place_title) }}</div>
                                            <span>
                                                <div>
                                                    <img class="place-nav-img" src="{{ asset($place->image_path) }}">
                                                    <div class="marker-table">
                                                        <div><span class="route-extra"><i class="fa fa-clock-o" aria-hidden="true"></i>{{ $place->duration }}</span></div>
                                                        <div><span class="route-extra"><i class="fa fa-map-marker" aria-hidden="true"></i>{{ $place->place_name_short }}</span></div>
                                                    </div>
                                                </div>

                                            <div class="route-item-exp">
                                                @foreach( array_intersect_key($experiences, array_flip($place->experiences)) as $exp)
                                                    <span><i class="fa fa-hashtag" aria-hidden="true"></i>{{$exp}}</span>
                                                @endforeach
                                            </div>
                                        </span>
                                    </span>
                                </a>
                            </li>

                        @endforeach
                    </ol>
                </div>

                <!-- ifrom div for googleMap -->
                <div class="col-md-8 col-sm-7 col-xs-12">
                    <div id="day-{{$day->day_num}}-map" class="dayMap"
                         data-dayid="{{ $day->day_num }}"
                         data-places="{{ $day->places }}">

                    </div>
                </div>
            </div>


            <!-- day places id="day-route"-->
            <div class="col-md-8 col-md-offset-4 col-xs-12 dayPlace">
                    @foreach($day->places as $key => $place)
                        <article id='day{{ $day->day_num }}-route{{($key)}}'  class="day{{$day->day_num}}">
                            <h3>{{ $place->place_title }}</h3>
                            <span class="place-extra">{{ $place->place_name_long }}</span>


                            <div class="row">
                                <img class="col-sm-4" src="/{{ $place->image_path }}">
                                <ul class="route-detail-table list-unstyled col-sm-8 col-xs-12">
                                    <li>
                                        time to visit
                                        <span class="pull-right">{{ $place->time_to_visit }}</span>
                                    </li>
                                    <li>
                                        business hours
                                        <span class="pull-right">{{ $place->business_hours }}</span>
                                    </li>
                                    <li>
                                        duration
                                        <span class="pull-right">{{ $place->duration }}</span>
                                    </li>
                                    <li>
                                        public transportation
                                        <span class="pull-right">{{ $place->public_transit }}</span>
                                    </li>
                                    <li>
                                        category
                                        <div class="pull-right route-item-exp">
                                            @foreach( array_intersect_key($experiences, array_flip($place->experiences)) as $exp)
                                                <span class=""><i class="fa fa-hashtag" aria-hidden="true"></i>{{$exp}}</span>
                                            @endforeach
                                        </div>

                                    </li>
                                </ul>
                            </div>


                            <div>

                                <p class="route-detail-title">Intro</p>
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
                                    <p class="route-detail-title">Restaurants nearby</p>
                                    <div>{!! $place->restaurants !!}</div>
                                @endif

                                @if($place->info_links != '')
                                    <p class="route-detail-title">Info websites</p>
                                    <div>{!! $place->info_links !!}</div>
                                @endif
                            </div>
                        </article>
                    @endforeach
            </div>


        </div>
    </div>

</div>

<div class="clearfix"></div>
