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


            <!-- ifrom div for googleMap -->
            <div id="day-{{$day->day_num}}-map" class="col-xs-12  top-buffer dayMap"
                 data-dayid="{{ $day->day_num }}"
                 data-places="{{ $day->places }}">

            </div>


            <!-- day places -->
            <div class="container">
                <div class="row" id="day-route">
                    <div class="iti-route col-xs-12 ">
                        <div class="row">
                            <h3 class="col-xs-12">Places to visit in this day</h3>


                            @include('itineraryDay.day-scroll')



                            <ol class="route-list col-md-4 col-xs-12 list-unstyled hidden-xs">
                                @foreach($day->places as $key => $place)

                                    <li>
                                    <a href='#day{{ $day->day_num }}-route{{($key)}}'>
                                        <span class="route-letter">{{ $place->letterLabel() }} </span>
                                        <span class="route-item">
                                            {{ $place->place_title }}
                                            <div class="marker-table">
                                                <span class="route-extra mark"><i class="fa fa-map-marker" aria-hidden="true"></i></span><span  class="route-extra detail">{{ $place->place_name_short }}</span>
                                            </div>
                                            <div>
                                                <span class="route-extra"><i class="fa fa-clock-o" aria-hidden="true"></i>{{ $place->duration }}</span>
                                                <span class="route-extra"><i class="fa fa-usd" aria-hidden="true"></i>{{ $place->price_range }}</span>
                                            </div>
                                            <div>
                                                @foreach( array_intersect_key($experiences, array_flip($place->experiences)) as $exp)
                                                    <span class="route-item-exp">{{$exp}}</span>
                                                @endforeach
                                            </div>
                                        </span>
                                    </a>
                                    </li>

                                @endforeach
                            </ol>

                            @foreach($day->places as $key => $place)
                                <article id='day{{ $day->day_num }}-route{{($key)}}'  class="col-md-8 col-xs-12 day{{$day->day_num}}">
                                    <h3>{{ $place->place_title }}</h3>
                                    <p class="place-extra">{{ $place->place_name_long }}</p>


                                    <div class="row">
                                        <img class="col-md-4 col-xs-12" src="/{{ $place->image_path }}">
                                        <ul class="route-detail-table list-unstyled col-md-8 col-xs-12">
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
                                                price range
                                                <span class="pull-right">{{ $place->price_range }}</span>
                                            </li>
                                            <li>
                                                transportation required
                                                <span class="pull-right">{{ $place->transportation }}</span>
                                            </li>
                                            <li>
                                                category
                                                <div class="pull-right">
                                                    @foreach( array_intersect_key($experiences, array_flip($place->experiences)) as $exp)
                                                        <span class="route-item-exp">{{$exp}}</span>
                                                    @endforeach
                                                </div>

                                            </li>
                                        </ul>
                                    </div>


                                    <div>
                                        <p class="route-detail-title">Intro</p>
                                        <p>{{ $place->place_intro }}</p>
                                        <p class="route-detail-title">What to do</p>
                                        <p>{{ $place->to_do }}</p>
                                        <p class="route-detail-title">What to eat</p>
                                        <p>{{ $place->to_eat }}</p>
                                        <p class="route-detail-title">Helpful tips</p>
                                        <p>{{ $place->tips }}</p>
                                    </div>
                                </article>
                            @endforeach
                        </div><!-- row -->
                    </div>
                </div><!-- row -->
            </div>

            <script>
                $('#day{{ $day->day_num }}').ddslick({
                    truncateDescription: true,
                    width: 'inherit',
                    electText: "Select A Place",
                    onSelected: function(selectedData){
                        //callback function: do something with selectedData;
                        $('article.day{{$day->day_num}}').each(function(){
                            $(this).hide();
                        });
                        $('article#day{{ $day->day_num }}-route'+selectedData.selectedIndex).show();
                    }
                });
            </script>

        </div>
    </div>

</div>

<div class="clearfix"></div>



