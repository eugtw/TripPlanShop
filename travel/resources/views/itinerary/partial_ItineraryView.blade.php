<div id="itit-header">

    <div class="row">
        <p class="itit-pub-date col-xs-12">Published: {{ $itinerary->created_at->diffForHumans() }}<br> Edited:
            {{ $itinerary->updated_at->diffForHumans() }}</p>
        <h1 class="col-xs-12">{{$itinerary->title}}</h1>
        <div class="clearfix"></div>

        <!-- comment and review block -->
        <div class="col-xs-12">
            <div class="inline-block pull-left">
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_sharing_toolbox inline-block"></div>
            </div>


            <!-- leave a comment link -->
            <div class="review-block">
                @include('includes.inc-review')

                @if( Auth::check() &&
                        !$itinerary->transactions->where('id',Auth::user()->id)->isEmpty() &&
                        $itinerary->reviews->where('user_id',Auth::user()->id)->isEmpty() &&
                        $itinerary->user_id != Auth::user()->id )
                    <a href="#" data-toggle="modal" data-target="#reviewModal_{{ $itinerary->getRouteKey() }}"><span id="" class="glyphicon glyphicon-star-empty"></span>rate this itinerary</a>
                @endif
            </div>
            <div class="clearfix"></div>
        </div>
    </div>




</div>

<div class="row">
    <div class="col-xs-12">
        <div class="itit-header-box" id="iti-header-div">
            {{--image is done  thru background--}}

            <div class="iti-big-purchase">
                @include('includes.iti_purchase_block')
            </div>
            <script>
                //background image replacement
                var image_path = <?php echo json_encode($itinerary->image_path); ?>;

                if(image_path == '')
                {
                    image_path = '/nowhere';
                }else{
                    image_path = '/'+image_path;

                }
                jQuery.ajax({
                    url: image_path,
                    type: "HEAD",
                    success: function(){
                        $("#iti-header-div").css('background-image',
                                'url("'+this.url+'")');
                    }
                });
            </script>
        </div><!-- pv-header-box -->
    </div>
</div>


    <div class="row">

        <!-- author info block -->
        <div class="col-sm-8 col-xs-12 itit-author ">
            <a  class="author-avatar" target="_blank" href="{{ route('user.show', $itinerary->user) }}">
                <img class="img-circle img-responsive"
                         src="{{ ($itinerary->user->profile->avatar == null  ? env('USER_AVATAR_PATH') . 'default_user.jpg' : $itinerary->user->profile->avatar) }}">
            </a>
            <div class="iti-author-info">
                <div>
                    <a class="name" target="_blank" href="{{ route('user.show', $itinerary->user) }}">
                        {{$itinerary->user->name}}</a>
                </div>
                <div>
                    <a class="theme-orange" target="_blank" href="http://{{ $itinerary->user->profile->blog_link }} ">
                        {{ $itinerary->user->profile->blog_link }} </a>
                </div>
            </div>
        </div>

    </div>

<div class="row">
    <!-- summary -->
    <div class="col-sm-8 col-xs-12">

            <h2 class="">About This itinerary</h2>
            <p class="itit-summary">{{ $itinerary->summary }}</p>

            <div class="items-list">
                    <ul class="list-unstyled">
                        <li>
                            <div class="col-sm-3 col-xs-12 items-cat">DURATION:</div>
                            <div class="col-sm-9 col-xs-12">{!!$itinerary->days()->count()!!}
                                        <span>
                                            Day{{ ($itinerary->days()->count() > 1) ? 's' :  ''}}
                                        </span></div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="col-sm-3 col-xs-12 items-cat">TRIP STYLES</div>
                            <div class="col-sm-9 col-xs-12">
                                <ul class="list-unstyled items-2-col">
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
                            <div class="col-sm-9 col-xs-12">
                                <p>n/a (per person / accom. not included)</p>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="col-sm-3 col-xs-12 items-cat">TOP PLACES</div>
                            <div class="col-sm-9 col-xs-12">
                                <ul class="list-unstyled items-2-col">
                                    @foreach(explode(',', $itinerary->top_places)  as $tp)
                                        {{--@if($tp != explode(',', $itinerary->top_places)[0])
                                            <span> | </span>
                                        @endif --}}
                                        <li><span>- </span> {{ $tp }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="col-sm-3 col-xs-12 items-cat">BEST TIME TO VISIT</div>
                            <div class="col-sm-9 col-xs-12">
                                {{ $itinerary->best_season }}
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="col-sm-3 col-xs-12 items-cat">REGION</div>
                            <div class="col-sm-9 col-xs-12">
                                {{ $itinerary->region->region }}
                            </div>
                            <div class="clearfix"></div>
                        </li>
                        <li>
                            <div class="col-sm-3 col-xs-12 items-cat">DESTINATION CITIES</div>
                            <div class="col-sm-9 col-xs-12">
                                <ul class="list-unstyled">
                                    @foreach($itinerary->cities as $c)
                                        {{-- @if($c != $itinerary->cities[0])
                                             <span> | </span>
                                         @endif --}}
                                        <li>{{ $c->city  }}, {{$c->country->country}}</li>
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

    <div class="col-xs-12">
            <div class="top-buffer text-center">
                {{-- change scandir() and <img src=""> --}}
                @if($itinerary->gallery_folder_name != ''&& file_exists('./files/'.$itinerary->gallery_folder_name))
                    @foreach( scandir('./files/'.$itinerary->gallery_folder_name) as $key => $filename)
                        @if($filename != '.' && $filename != '..' && $filename != '.tmb' )
                            <div class="photo-box " {{$key > 10 ? 'hidden=true' : ''}}>
                                <a class="colorbox-pic" href="{{ENV('APP_ENV') == 'prod' ? secure_url('/files/'.$itinerary->gallery_folder_name.'/'.$filename) : url('/files/'.$itinerary->gallery_folder_name.'/'.$filename)  }}">
                                    <img class="img-responsive img-thumbnail" src="{{ENV('APP_ENV') == 'prod' ? secure_url('/files/'.$itinerary->gallery_folder_name.'/'.$filename) : url('/files/'.$itinerary->gallery_folder_name.'/'.$filename)  }}" alt="{{$filename}}">
                                </a>
                            </div>
                        @endif
                    @endforeach
                    <div class="photo-box open-link">
                        <a href="#" id="openGallery" class="">Gallery <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                @endif

                <script>
                    $(function(){
                        $('.photo-box').matchHeight();
                    });
                    $(document).ready(function($){
                        var gallery = $("a.colorbox-pic").colorbox();
                        $("a#openGallery").click(function(e){
                            e.preventDefault();
                            gallery.eq(0).click();
                        });
                    });
                </script>
            </div>
        </div>
</div>

<!-- daily plans nav bar -->
@if(!$is_preview)
    <div class="row">
        <!-- day sticky navbar -->
        <div id="sticky">
            <nav  id="sticky-nav" >
                <ul class="nav nav-pills">
                    <li><a href="#">Day</a></li>
                    @foreach($itinerary->days($is_preview)->orderby('day_of_itinerary')->get() as $day)
                        <li class="text-center"><a href="#day-{{ $day->day_of_itinerary }}">{{$day->day_of_itinerary}}</a></li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
@endif






<!-- days container -->
@include('itineraryDay.view')


    <script>
        var $li = $('#sticky li').click(function() {
            $li.removeClass('selected');
            $(this).addClass('selected');
        });


        $('a.colorbox-pic').colorbox({
            rel: 'colorbox-pic',
            transition:"none",
            opacity:0.60,
            innerWidth: '80%',
            innerHeight: '60%'
        });
    </script>

