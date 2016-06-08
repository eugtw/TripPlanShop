@extends('app', ['title' => $itinerary->title . ': Travel Itinerary On TripPlanShop'])

@section('meta-og')
    <meta property="og:url"                content="{{ route('itinerary.show',$itinerary->slug) }}">
    <meta property="og:type"               content="article">
    <meta property="og:title"              content="{{ $itinerary->title }}">
    <meta property="og:description"        content="{{ $itinerary->summary }}">
    <meta property="og:image"              content="http://tripplanshop.com{{ preg_replace('/ /', '%20', env('IMAGE_ROOT') . $itinerary->image)   }}">
    <meta property="og:site_name" content="TripPlanShop"/>
    <meta property="fb:app_id"             content="{{ env('FB_CLIENT_ID') }}"
@stop

@section('snippet-data')
    @include('includes.searchSnippets')
@stop

@section('content')
    <div id="iti-header" class="text-center"
         style = "background-image: url('{{ asset($itinerary->image_path) }}');">
        <div class="overlay"></div>

        <div class="content-container container">
            <div class="row">
                <h1 class="col-xs-12 col-md-10 col-md-offset-1">{{$itinerary->title}}</h1>

                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <ul class="list-unstyled list-inline">
                        @foreach($itinerary->styles as $style)
                            <li class="style-tag">{{ $style->style }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>


            <span class="by-whom">planned by <span class="author-name"><i>{{$itinerary->authorName()}}</i></span></span>

            <div class="img-author">
                <a href="{{ route('user.show', $itinerary->user) }}">
                        <img src="{{$itinerary->authorAvatar()}}">
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
    <div class="container bottom-buffer" id="iti-overview">
        <div class="row">

            <div class="col-sm-8 col-xs-12">
                <h2 class="">About This itinerary</h2>

                <p class="itit-pub-date inline-block">Published: {{ $itinerary->created_at->diffForHumans() }}<br> Edited:
                    {{ $itinerary->updated_at->diffForHumans() }}</p>

                <hr class="">

                <div class="itit-summary">{!! $itinerary->summary !!}</div>


                <h2 class="">Highlights</h2>
                <div class="items-list">
                    <ul class="list-unstyled">
                        <li>
                            <div>
                                <span class="items-cat col-xs-4 ">DURATION:</span>
                                <span class="items-detail col-xs-8">{!!$itinerary->days()->count()!!}
                                        <span>
                                            Day{{ ($itinerary->days()->count() > 1) ? 's' :  ''}}
                                        </span>
                                </span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div>
                                <span class="col-xs-4 items-cat">TRIP STYLES:</span>
                                <span class="items-detail col-xs-8">
                                    <ul class="list-unstyled ">
                                        @foreach($itinerary->styles as $style)
                                            {{--@if($style != $itinerary->styles[0])
                                                <span> | </span>
                                            @endif --}}
                                            <li>{{ $style->style }}</li>
                                        @endforeach
                                    </ul>
                                </span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div>
                                <span class="items-cat col-xs-4 ">Cost Estimate:</span>
                                <span class="items-detail col-xs-8">
                                        <span>
                                            $ na (per person / accom. not included)
                                        </span>
                                </span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div>
                                <span class="items-cat col-xs-4 ">DESTINATION CITIES:</span>
                                <span class="items-detail col-xs-8">
                                    <ul class="list-unstyled ">
                                        @foreach($itinerary->cities as $c)
                                            {{-- @if($c != $itinerary->cities[0])
                                                 <span> | </span>
                                             @endif --}}
                                            <li class="items-detail">{{ $c->city  }}, {{$c->country->country}}</li>
                                        @endforeach
                                    </ul>
                                </span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div>
                                <span class="items-cat col-xs-4 ">BEST SEASON:</span>
                                <span class="items-detail col-xs-8">
                                        <span>
                                             {{ $itinerary->best_season }}
                                        </span>
                                </span>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                    </ul>
                </div><!-- items-list-box -->

                <ul class="list-unstyled daySummary">
                    @foreach($itinerary->days as $day)
                        <li>
                            <span class="dayTitle">Day {{$day->day_num . ': '}}{{ $day->title }}</span>
                            <div class="dayIntro more">{{ strip_tags($day->intro) }}</div>
                        </li>
                    @endforeach
                </ul>
                <div class="clearfix"></div>
            </div>

            <!-- pv-info-block -->
            <div class="col-sm-4 col-xs-12 pull-right">
                @if(Auth::check() && $itinerary->user_id == Auth::user()->id)
                    {{--- is user the author? and itinerary not published? If so, show edit button ---}}
                    @if(!$is_preview && $itinerary->published == env("ITI_NOT_PUBLISHED") )
                        <div class="">
                            {!! Form::open(['route'=>['itinerary.edit', $itinerary->slug], 'method'=>'get']) !!}

                            {!! Form::submit('Edit Overview', ['class'=>'btn-info author-button']) !!}
                            {!! Form::close() !!}
                        </div>
                    @endif


                    @if($itinerary->published == env("ITI_PUBLISHED"))
                        <a type="button" class="btn-info text-center author-button" href="{{route('itinerary.unpublish',$itinerary->slug)}}">
                            Unpublish and Edit
                        </a>
                    @else
                        {{-- cannot publich if iti doesnt have even 1 day details--}}
                        @if($itinerary->days->count() >= 1)
                            <a type="button" class="btn-info text-center author-button" href="{{route('itinerary.publish',$itinerary->slug)}}">
                                Publish
                            </a>
                            <a type="button" class="btn-info text-center author-button" href="{{route('user.show', [Auth::user()])}}">
                                Save
                            </a>
                        @endif
                    @endif
                @endif



                @if($is_preview == 1)
                    <div class="buy-block text-center">

                        @if( $itinerary->price == 0 )
                            <a type="button" class="buy-button" href="{{ route('itinerary.getItiFree', $itinerary->slug) }}">Get this Free</a>
                        @else
                            <a type="button" class="buy-button"href="{{ route('itinerary.purchaseConfirm', $itinerary->slug) }}">
                                BUY<sup> $</sup><span>{{ $itinerary->price }}</span><sup> US</sup></a>
                        @endif


                    </div>

                    <div class="buy-block text-center">
                        <a type="button" class="buy-button" href="#" id="fav-{{$itinerary->getRouteKey()}}">
                            <span class="glyphicon glyphicon-heart heart {{ $itinerary->liked() ? 'theme-pink' : ''}}"></span>SAVE TO COLLECTION</a>
                    </div>
                @endif

                <ul class="itit-info-block list-unstyled">
                    <li>
                        <p>WHAT YOU WILL GET</p>
                        <ul class="list-unstyled">
                            @foreach($items as $key => $i)
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

    <!-- day sticky navbar -->
    @include('itinerary.partial_sticky_nav')




<!-- daily plan -->
@include('itineraryDay.view')

    <!-- footer buttons -->
    @include('itinerary.partial_iti_footer')


    @include('includes.disqus')
    @include('itinerary.review_modal')
@stop

@section('js-bottom')

    <script>
        //day-nav scroll spy

        $('body').scrollspy({ target: '#sticky' })
        $(document).on('click','.navbar-collapse.in',function(e) {
            if( $(e.target).is('a') ) {
                $(this).collapse('hide');
            }
        });
    </script>

    <script>
        //add/delete item to/from favorite list
        (function($) {
            $("#fav-"+"{{ $itinerary->getRouteKey() }}").on('click', function(e) {
                e.preventDefault();
                $.get('{{url(route('itinerary.favorite',$itinerary->slug))}}',function (data) {
                    if(data == 'added')
                    {
                        $(e.target).removeClass('').addClass('theme-pink');
                    }
                    else{
                        $(e.target).removeClass('theme-pink').addClass('');
                    }

                }).error(function(data) {
                    //redirect to login,
                    window.location.href = "/login";
                });

            });
        })(jQuery);
    </script>
    <script>
        //shorten day summary in iti overview
        var showChar = 200;  // How many characters are shown by default
        var ellipsestext = "...";
        var moretext = "Show more >";
        var lesstext = "Show less";


        $('.more').each(function() {
            var content = $(this).html();

            if(content.length > showChar) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                $(this).html(html);

            }

        });

        $(".morelink").click(function(){
            if($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
    </script>

    <script>
        //day sticky nav bar
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
                $.get('{{url(route('itinerary.favorite',$itinerary->slug))}}',function (data) {
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
        //display each day's map summary for places
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

                var marker = [];
                var contentString = [];
                var infowindow = [];

                for (var i = 0; i < loc.length; i++) {
                    if(loc[i].loc_lat != '' && loc[i].loc_lng != '')
                    {
                        marker[i] = new google.maps.Marker({
                            position: new google.maps.LatLng(loc[i].loc_lat, loc[i].loc_lng),
                            map: window['map' + id],
                            animation: google.maps.Animation.DROP,
                           // icon: pinImage,
                            label: labels[labelIndex % labels.length]
                        });
                        window['bounds' + id].extend(marker[i].position);
                    }
                    labelIndex++;
                    window['map' + id].fitBounds(window['bounds' + id]);


                    var title = loc[i].place_title != '' ? loc[i].place_title : "n/a";
                    var name = loc[i].place_address != '' ? loc[i].place_address : "n/a";
                    var duration = loc[i].duration != '' ? loc[i].duration : "n/a";
                    contentString[i] = '<div class="placeMarker">' +
                                        '<p class="title">' + title + '</p>' +
                                        '<ul class="list-unstyled">'+
                                        '<li><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>' + name + '</li>' +
                                        '<li><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>' + duration + '<li>' +
                                        '</ul>'+
                                        '</div>';

                    infowindow[i]= new google.maps.InfoWindow({
                        content: contentString[i]
                    });

                    (function(j){
                        return function() {
                            if(marker[j]) {
                                marker[j].addListener('click', function() {
                                    infowindow[j].open(window['map' + id], marker[j]);
                                });
                            }
                        }()
                    })(i);
                }
            });
        }//initMap()
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap">
    </script>
@stop