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
                    <!-- iframe div for googleMap -->
                    <div class="bottom-buffer col-xs-12 dayMapCont">
                        <div id="day-{{$day->day_num}}-map" class="dayMap"
                             data-dayid="{{ $day->day_num }}"

                             {{---
                             data-places='
                            @foreach( $day->places as $p )
                            [&quot;{{$p}}&quot;@if(end($day->places) != $p ){{','}}@endif]
                            '>
                            @endforeach
                                     ---}}
                        </div>
                    </div>
                </div>

                <!-- day places id="day-route"-->

                <div class="dayView">
                    <div class="iti-route bottom-buffer  col-md-4 col-sm-5 col-xs-12"
                         data-dayid="{{ $day->day_num }}"
                         data-num="{{$day->places->count() }}">
                        <ol class="route-list view-mode list-unstyled">
                            @foreach($day->places as $key => $place)
                            <li>
                                <a href='place-{{ $place->id }}'
                                   id="day{{ $day->day_num }}-route{{($key)}}"
                                   data-lat = "{{ $place->loc_lat }}"
                                   data-lng = "{{ $place->loc_lng }}"
                                   data-title = "{{ $place->place_title }}"
                                   data-address = "{{ $place->place_address }}"
                                   data-duration = "{{ $place->duration }}
                                   ">

                                    <span class="route-item">
                                        <div><span class="route-letter">{{ $place->letterLabel() }} </span>{{ ucwords($place->place_title) }}</div>

                                        <div>
                                        @if( $place->image_path == '')
                                            <img class="place-nav-img" src="{{ $place->photo_ref_google }}" alt="{{ $place->title }}">
                                        @else
                                            <img class="place-nav-img" src="{{ asset($place->image_path) }}" alt="{{ $place->title }}">
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
                                </a>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                    <article  class=" col-md-8 col-sm-7 col-xs-12 dayPlace">
                        {{--- content is loaded thru ajax call to 'partial_PlaceView' ---}}
                    </article>
                </div>

            </div><!-- row -->
        </div>
    </div>
</div>

<div class="clearfix"></div>
