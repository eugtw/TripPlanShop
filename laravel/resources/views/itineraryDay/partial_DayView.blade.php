<div id="day-{{$day->day_of_itinerary}}">
    <div class="itiday-box top-buffer" id="day_{!! $day->day_of_itinerary !!}">

        <span class="day-number">{!! 'DAY ' . $day->day_of_itinerary !!}</span>

        <div class="clearfix"></div>
        @if(!$is_preview && $itinerary->user_id == Auth::user()->id && $itinerary->published == 0)
            {!! Form::model($day,['route'=>['itinerary-day.edit', $day], 'method'=>'GET','class'=>'pull-left']) !!}
            {{-- send day_of _itinerary thru hidden form --}}
            <div class="">
                {!! Form::submit('Edit This Day', ['class'=>'btn btn-info']) !!}
            </div>
            {!! Form::close() !!}
            <div class="clearfix"></div>
        @endif

        <!-- day overview block -->
        <div class="top-buffer">
            <div class="day-feature-img col-sm-9 col-xs-12">

                @if( $day->image != null )
                    <img src="{{ENV('APP_ENV') == 'prod' ? secure_url(env('IMAGE_ROOT') .$day->image) : url(env('IMAGE_ROOT') .$day->image) }}">
                @else
                    <span></span>
                @endif
            </div>
            <div class="day-info-block col-sm-3 col-xs-12">
                <div>
                    <h3 class="">destination cities</h3>
                    <ol class="">
                        @foreach( explode(',', $day->day_cities) as $p)
                            <li>{{ $p }}</li>
                        @endforeach
                    </ol>
                </div>

                <div>
                    <h3 class="">places to visit</h3>
                    <ol class="">
                        @foreach( explode(',', $day->places) as $p)
                            <li>{{ $p }}</li>
                        @endforeach
                    </ol>
                </div>


                <div>
                    <h3 class="">top experiences</h3>
                    <ul class="list-unstyled">
                        @foreach($day->getTopExpNames() as $exp)
                            <li>{{ $exp->experience }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div><!-- day overview block -->

        <div class="day-intro col-sm-9 col-xs-12">
            <q>{{$day->intro}}</q>
        </div>

        <div class="day-content col-sm-9 col-xs-12">
            <article>
                {!! $day->summary !!}
            </article>
        </div>

    </div>

</div>


<div class="clearfix"></div>