<div class="container" id="day-{{$day->day_num}}">
    <div class="row">

        <div class="itiday-box top-buffer">

            <div class="col-xs-12">
                <span class="day-number">{!! 'DAY ' . $day->day_num !!}</span>

                <div class="clearfix"></div>
                @if(!$is_preview && $itinerary->user_id == Auth::user()->id && $itinerary->published == 0)
                    {!! Form::model($day,['route'=>['itinerary-day.edit', $day], 'method'=>'GET','class'=>'pull-left']) !!}
                    {{-- send day_num thru hidden form --}}
                    <div class="">
                        {!! Form::submit('Edit This Day', ['class'=>'btn btn-info']) !!}
                    </div>
                    {!! Form::close() !!}
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
            <div id="iti-day-map" class="col-xs-12  top-buffer">
                {!! $day->map !!}
            </div>


            <!-- day places -->
            <div class="row" id="day-route">
                <div class="iti-route col-xs-12 ">
                    <div class="row">
                        <h3 class="col-xs-12">Places to visit in this day</h3>
                        <ol class="route-list route-day{{ $day->day_num }} col-md-4 col-xs-12 list-unstyled">
                            @foreach($day->places as $key => $place)

                                <li>
                                <a href='#day{{ $day->day_num }}-route{{($key+1)}}'>
                                    <span class="route-letter">{{($key+1)}} </span>
                                <span class="route-item">
                                    {{ $place->place_title }}
                                    <div>
                                        <span class="route-extra"><i class="fa fa-map-marker" aria-hidden="true"></i>St. John's</span>
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
                        <article id='day{{ $day->day_num }}-route{{($key+1)}}'  class="col-md-8 col-xs-12">
                            <h3>{{ $place->place_title }}</h3>
                            <p class="place-extra">St. John's</p>


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

            {{-- jquery tabs --}}
            <script>
                $("ol.route-day{{ $day->day_num }}").each(function(){
                    // For each set of tabs, we want to keep track of
                    // which tab is active and its associated content
                    var $active, $content, $links = $(this).find('a');

                    // If the location.hash matches one of the links, use that as the active tab.
                    // If no match is found, use the first link as the initial active tab.
                    $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
                    $active.addClass('active');

                    $content = $($active[0].hash);

                    // Hide the remaining content
                    $links.not($active).each(function () {
                        $(this.hash).hide();
                    });

                    // Bind the click event handler
                    $(this).on('click', 'a', function(e){
                        // Make the old tab inactive.
                        $active.removeClass('active');
                        $content.hide();

                        // Update the variables with the new link and content
                        $active = $(this);
                        $content = $(this.hash);

                        // Make the tab active.
                        $active.addClass('active');
                        $content.show();

                        // Prevent the anchor's default click action
                        e.preventDefault();
                    });
                });
            </script>

        </div>
    </div>

</div>

<div class="clearfix"></div>
