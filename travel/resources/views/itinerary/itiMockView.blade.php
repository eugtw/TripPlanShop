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
    <div id="iti-header" class="text-center"
         style = "background-image: url('/{{$itinerary->image_path}}');">
        <div class="overlay"></div>

        <div class="content-container">
            <h1>{{$itinerary->title}}</h1>

            <div>
                <ul class="list-unstyled list-inline">
                    @foreach($itinerary->styles as $style)
                        <li class="style-tag">{{ $style->style }}</li>
                    @endforeach
                </ul>
            </div>

            <span class="author-name">By {{$itinerary->user->name}}</span>

            <div class="img-author">
                <a href="{{ route('user.show', $itinerary->user) }}">
                    @if($itinerary->user->profile->avatar != '')
                        <img src="{{$itinerary->user->profile->avatar}}">
                    @else
                        <img src="/images/avatars/default_user.jpg">
                    @endif
                </a>
            </div>

            <!-- comment and review block -->
            <div>
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_sharing_toolbox inline-block"></div>
            </div>


            <!-- leave a comment link -->
            <div class="">
                @include('includes.inc-review')

                @if( Auth::check() &&
                            !$itinerary->transactions->where('id',Auth::user()->id)->isEmpty() &&
                            $itinerary->reviews->where('user_id',Auth::user()->id)->isEmpty() &&
                            $itinerary->user_id != Auth::user()->id )
                    <a href="#" data-toggle="modal"
                                data-target="#reviewModal_{{ $itinerary->getRouteKey() }}">
                        <span id="" class="glyphicon glyphicon-star-empty"></span>rate this itinerary
                    </a>
                @endif
            </div>
        </div><!-- .content-container -->
    </div><!-- #iti-header -->


    <!-- summary -->
    <div class="container" id="iti-overview">
        <div class="row">

            <div class="col-sm-8 col-xs-12">
                @if(Auth::check() && $itinerary->user_id == Auth::user()->id)
                    {{--- is user the author? and itinerary not published? If so, show edit button ---}}
                    @if(!$is_preview && $itinerary->published == env("ITI_NOT_PUBLISHED") )
                        <div class="inline-block top-buffer bottom-buffer">
                            {!! Form::open(['route'=>['itinerary.edit', $itinerary], 'method'=>'get']) !!}

                            {!! Form::submit('Edit Overview', ['class'=>'btn btn-info']) !!}
                            {!! Form::close() !!}
                        </div>
                    @endif


                    @if($itinerary->published == env("ITI_PUBLISHED"))
                        <a type="button" class="btn btn-info text-center top-buffer bottom-buffer" href="{{route('itinerary.unpublish',[$itinerary])}}">
                            Unpublish and Edit
                        </a>
                    @else
                        {{-- cannot publich if iti doesnt have even 1 day details--}}
                        @if($itinerary->days->count() >= 1)
                            <a type="button" class="btn btn-info text-center top-buffer bottom-buffer" href="{{route('itinerary.publish',[$itinerary])}}">
                                Publish
                            </a>
                            <a type="button" class="btn btn-info text-center top-buffer bottom-buffer" href="{{route('user.show', [Auth::user()])}}">
                                Save
                            </a>
                        @endif
                    @endif
                @endif


                <h2 class="">About This itinerary</h2>

                <p class="itit-pub-date inline-block">Published: {{ $itinerary->created_at->diffForHumans() }}<br> Edited:
                    {{ $itinerary->updated_at->diffForHumans() }}</p>

                <hr class="">

                <p class="itit-summary">{!! nl2br($itinerary->summary) !!}</p>

                <div class="items-list">
                    <ul class="list-unstyled">
                        <li>
                            <div class="col-sm-3 col-xs-12 items-cat">DURATION:</div>
                            <div class="col-sm-9 col-xs-12 items-detail">{!!$itinerary->days()->count()!!}
                                        <span>
                                            Day{{ ($itinerary->days()->count() > 1) ? 's' :  ''}}
                                        </span></div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="col-sm-3 col-xs-12 items-cat">TRIP STYLES</div>
                            <div class="col-sm-9 col-xs-12 items-detail">
                                <ul class="list-unstyled ">
                                    @foreach($itinerary->styles as $style)
                                        {{--@if($style != $itinerary->styles[0])
                                            <span> | </span>
                                        @endif --}}
                                        <li>{{ $style->style }}</li>
                                    @endforeach
                                </ul></div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="col-sm-3 col-xs-12 items-cat">BUDGET</div>
                            <div class="col-sm-9 col-xs-12 items-detail">
                                <p>$ na (per person / accom. not included)</p>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="col-sm-3 col-xs-12 items-cat">TOP PLACES</div>
                            <div class="col-sm-9 col-xs-12 items-detail">
                                <ul class="list-unstyled">
                                    @foreach(explode(',', $itinerary->top_places)  as $tp)
                                        {{--@if($tp != explode(',', $itinerary->top_places)[0])
                                            <span> | </span>
                                        @endif --}}
                                        <li><span></span> {{ $tp }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="col-sm-3 col-xs-12 items-cat">BEST TIME TO VISIT</div>
                            <div class="col-sm-9 col-xs-12 items-detail">
                                {{ $itinerary->best_season }}
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="col-sm-3 col-xs-12 items-cat">REGION</div>
                            <div class="col-sm-9 col-xs-12">
                                <span class="items-detail">{{ $itinerary->region->region }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="col-sm-3 col-xs-12 items-cat">DESTINATION CITIES</div>
                            <div class="col-sm-9 col-xs-12 ">
                                <ul class="list-unstyled">
                                    @foreach($itinerary->cities as $c)
                                        {{-- @if($c != $itinerary->cities[0])
                                             <span> | </span>
                                         @endif --}}
                                        <li class="items-detail">{{ $c->city  }}, {{$c->country->country}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                </div><!-- items-list-box -->

                <div class="clearfix"></div>
            </div>

            <!-- pv-info-block -->
            <div class="col-sm-4 col-xs-12 pull-right">

                @if($is_preview == 1)
                    <div class="buy-block text-center">



                        @if( $itinerary->price == 0 )
                            <a type="button" class="buy-button" href="{{ route('itinerary.getItiFree', $itinerary) }}">Get this Free</a>
                        @else
                            <a type="button" class="buy-button"href="{{ route('itinerary.purchaseConfirm', $itinerary) }}">
                                BUY<sup> $</sup><span>{{ $itinerary->price }}</span><sup> US</sup></a>


                        @endif


                    </div>

                    <div class="buy-block text-center">


                        <a type="button" class="buy-button"href="{{ route('itinerary.favorite',$itinerary) }}">
                            <span class="glyphicon glyphicon-heart heart {{ $itinerary->liked() ? 'theme-pink' : ''}}"></span>SAVE TO COLLECTION</a>



                    </div>
                @endif

                <ul class="itit-info-block list-unstyled">
                    <li>
                        <p>WHAT YOU WILL GET</p>
                        <ul class="list-unstyled">
                            @foreach($items as $key => $i)
                                @if($key == 0)
                                    <span class="info-block-subtitle">General</span>
                                @elseif($key == 5)
                                    <span class="info-block-subtitle">Recommendations</span>
                                @elseif($key == 9)
                                    <span class="info-block-subtitle">Destinations</span>
                                @endif
                                <li class="">
                                    @if( in_array($i->id, $itinerary->getItemsArray()) )
                                        <span class="glyphicon glyphicon-ok item-check-yes"></span><span class="pv-item-check-yes-text">{{ ' ' . $i->item }}</span>
                                    @else
                                        <span class="glyphicon glyphicon-remove item-check-no"></span><span class="pv-item-check-no-text">{{ ' ' . $i->item }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>


<div id="sticky">
    <div class="navbar navbar-default" id="sticky-nav">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#days-nav" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#top">Top</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="days-nav">
                <ul class="nav navbar-nav">
                    @foreach($itinerary->days($is_preview)->orderby('day_num')->get() as $day)
                        <li><a href="#day-{{ $day->day_num }}">Day{{$day->day_num}}</a></li>
                    @endforeach
                    <li><a href="#disqus">Comments</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </div>
</div>
    <!-- day sticky navbar -->
<script>
    $('body').scrollspy({ target: '#sticky-nav' })
    $(document).on('click','.navbar-collapse.in',function(e) {
        if( $(e.target).is('a') ) {
            $(this).collapse('hide');
        }
    });
</script>


    <!-- daily plan -->
    @include('itineraryDay.view')

    <!-- footer buttons -->
    <hr class="top-buffer">
    <div class="text-center top-buffer">

        @if($is_preview)
            @if($itinerary->price == 0)
                <a type="button" class="itit-button itit-footer-button btn-primary" href="{{ route('itinerary.getItiFree', $itinerary) }}">Add To List For Free</a>
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


    @include('includes.disqus')
    @include('itinerary.review_modal')
@stop

@section('js-bottom')
    <script>
        var $li = $('#sticky li').click(function() {
            $li.removeClass('selected');
            $(this).addClass('selected');
        });
    </script>

    <script>
        $(function(){
            $('.photo-box').matchHeight();
        });
    </script>

    {{-- add/delete item to/from favorite list --}}
    <script>
        (function($) {
            $("#"+"{{ $itinerary->getRouteKey() }}").on('click', function(e) {
                e.preventDefault();
                $.get('{{url(route('itinerary.favorite',$itinerary))}}',function (data) {
                    if(data == 'added')
                    {
                        $(e.target).removeClass('').addClass('theme-pink');
                    }
                    else{
                        $(e.target).removeClass('theme-pink').addClass('');
                    }

                }).error(function() {
                    //redirect to login,
                    window.location.href = "/login";
                });

            });
        })(jQuery);
    </script>

    <script id="dsq-count-scr" src="//tripplanshop.disqus.com/count.js" async></script>
    <script>
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        function initMap() {
            $('div.dayMap').each(function () {
                var labelIndex = 0;
                var loc = $(this).data('places');
                var id = $(this).data('dayid');
                window['bounds' + id] = new google.maps.LatLngBounds();

                window['map' + id] = new google.maps.Map(document.getElementById('day-'+id+'-map'), {
                    zoom: 7,
                    mousescroll: true
                    //center: {lat: 52.520, lng: 13.410}
                });


                for (var i = 0; i < loc.length; i++) {
                    if(loc[i].loc_lat != '' && loc[i].loc_lng != '')
                    {
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(loc[i].loc_lat, loc[i].loc_lng),
                            map: window['map' + id],
                            animation: google.maps.Animation.DROP,
                            label: labels[labelIndex % labels.length]
                        });

                        window['bounds' + id].extend(marker.position);
                    }

                    labelIndex++;
                }

                window['map' + id].fitBounds(window['bounds' + id]);
            });
        }//initMap()
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap">
    </script>
@stop