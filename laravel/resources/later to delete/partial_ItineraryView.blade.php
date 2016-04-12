
    <div id="pv-header">
        <div>
            <img class="img-circle pull-left" src="{{ ($itinerary->user->profile->avatar == null  ? env('USER_AVATAR_PATH') . 'default_user.jpg' : $itinerary->user->profile->avatar) }}">
            <span><span class="small">by </span><a class="size-medium" target="_blank" href="{{ route('user.show', $itinerary->user) }}"><i>{{$itinerary->user->name}}</i></a></span><br>
            <span><span class="small">published on </span>{{ $itinerary->created_at->format("Y-M-d") }}</span><br>
            <span><span class="small">last edited on </span>{{ $itinerary->updated_at->format("Y-M-d") }}</span>
        </div>

        <div class="clearfix"></div>
        <h1>{{$itinerary->title}}</h1>
        <div class="pv-rating star-yellow"> <!-- review star -->
                    <span class="">
                        @if($itinerary->reviews()->count() < 3)
                            {{"New!"}}
                        @else{
                        {{ round($itinerary->reviews()->avg('rating'),1) }}
                        @endif
                    </span>
            <span class="glyphicon glyphicon-star stars"></span>
            <span>( {{ $itinerary->reviews()->count() }} )</span>
        </div>


        <div class="clearfix"></div>
    </div>

    <div class="pv-header-box" id="div-{{ preg_replace('/ /', '_', $itinerary->title) }}">
        {{--image is done  thru background--}}

        <div id="pv-header-info-box">
            <a type="button" class="pv-header-buy-button" href="{{ route('itinerary.purchaseConfirm', $itinerary) }}">PURCHASE</a>
            <div class="clearfix"></div>

            <div id="pv-header-info-price">
                <sup>$</sup><span>{{ $itinerary->price }}</span><sup> CAD</sup>
                <a id="{{preg_replace('/ /', '_', $itinerary->title)}}" href="{{ route('itinerary.favorite',$itinerary) }}">
                    <span class="glyphicon glyphicon-heart heart {{ $itinerary->liked() ? 'theme-pink' : ''}}"></span>
                </a>
            </div><!-- pv-header-info-price -->

            <div class="clearfix"></div>

            <table class="table" id="pv-header-info-table">
                <tr>
                    <td>
                        <b id="pv-header-info-day">{!!$itinerary->days()->count()!!}</b>
                                        <span class="small">
                                            day{{ ($itinerary->days()->count() > 1) ? 's' :  ''}}
                                        </span>
                        </td>
                        <td>
                            <span class="pv-header-info-text small">Best time: </span><b><i>{{ $itinerary->best_season }}</i></b><br>
                            <span class="pv-header-info-text small">Budget: </span><b><i>{{ $itinerary->days()->sum('budget') }}</i></b><span class="small"> /person</span>
                        </td>
                </tr>
            </table>


            <script>
                //add/delete item to/from favorite list
                (function($) {
                    $("#{{preg_replace('/ /', '_', $itinerary->title)}}").on('click', function(e) {
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
                            window.location.href = "login";
                        });

                    });
                })(jQuery);
            </script>
        </div><!-- pv-header-info-box -->

        <script>
            //background image replacement
            var image_url = '{{url(env('IMAGE_ROOT') .$itinerary->image)}}';
            jQuery.ajax({
                url: image_url,
                type: "HEAD",
                success: function(){
                    jQuery("#div-{{ preg_replace('/ /', '_', $itinerary->title) }}").css('background-image',
                            'url({{ env('IMAGE_ROOT') .$itinerary->image }} )');
                }
            });
        </script>
    </div><!-- pv-header-box -->

    <div class="col-sm-4 col-xs-12 pull-right">
        <ul class="pv-info-block list-unstyled">
            <li>
                <p>ABOUT THIS TRIP</p>
                <ul class="list-unstyled">
                    <li>Duration:
                        {!!$itinerary->days()->count()!!}
                                        <span class="small">
                                            day{{ ($itinerary->days()->count() > 1) ? 's' :  ''}}
                                        </span> long
                    </li>
                    <li>Budget: {{ $itinerary->days()->sum('budget') }} / person</li>
                    <li>Season: {{ $itinerary->best_season }}</li>
                </ul>
            </li>
            <li>
                <p>STYLES</p>
                <ul class="list-unstyled">
                    @foreach($itinerary->styles as $style)
                        {{--@if($style != $itinerary->styles[0])
                            <span> | </span>
                        @endif --}}
                        <li>{{ $style->style }}</li>
                    @endforeach
                </ul>
            </li>
            <li>
                <p>REGION</p>
                <ul class="list-unstyled">
                    <li>{{ $itinerary->region->region }}</li>
                </ul>
            </li>
            <li>
                <p>FEATURED CITIES</p>
                <ul class="list-unstyled">
                    @foreach($itinerary->cities as $c)
                        {{-- @if($c != $itinerary->cities[0])
                             <span> | </span>
                         @endif --}}
                         <li>{{ $c->city  }}, {{$c->country->country}}</li>
                     @endforeach
                 </ul>
             </li>

             <li>
                 <p>TOP PLACES</p>
                 <ul class="list-unstyled">
                     @foreach(explode(',', $itinerary->top_places)  as $tp)
                         {{--@if($tp != explode(',', $itinerary->top_places)[0])
                             <span> | </span>
                         @endif --}}
                         <li>{{ $tp }}</li>
                     @endforeach
                 </ul>
             </li>
         </ul>
     </div>

     <div class="col-sm-8 col-xs-12">
         <p>{{ $itinerary->summary }}</p>

         <h4 class="top-buffer">Features:</h4>
         <div class="items-list-box">
             <fieldset class="group">
                 <ul class="list-unstyled">
                     @foreach($items as $i)
                         <li class="col-sm-6 col-xs-12">
                             @if( in_array($i->id, $itinerary->getItemsArray()) )
                                 <span class="glyphicon glyphicon-ok pv-item-check-yes"></span><span class="pv-item-check-yes-text">{{ ' ' . $i->item }}</span>
                             @else
                                 <span class="glyphicon glyphicon-remove pv-item-check-no"></span><span class="pv-item-check-no-text">{{ ' ' . $i->item }}</span>
                             @endif
                         </li>
                     @endforeach
                 </ul>
             </fieldset>
         </div><!-- items-list-box -->

         <div class="top-buffer text-center">
                 {{-- change scandir() and <img src=""> --}}
                 @if($itinerary->gallery_folder_name != ''&& file_exists('./files/'.$itinerary->gallery_folder_name))
                     @foreach( scandir('./files/'.$itinerary->gallery_folder_name) as $key => $filename)
                         @if($filename != '.' && $filename != '..' && $filename != '.tmb' )
                             <div class="photo-box " {{$key > 10 ? 'hidden=true' : ''}}>
                                 <a class="colorbox-pic" href="#">
                                     <img class="img-responsive" src="{{ '/files/'.$itinerary->gallery_folder_name.'/'.$filename  }}">
                                 </a>
                             </div>
                         @endif
                     @endforeach
                     <div class="photo-box ">
                         <a href="#" id="openGallery" class="">Open Gallery</a>
                     </div>
                 @endif

                 <script>
                     jQuery(function(){
                         $('.photo-box').matchHeight();
                     });
                     jQuery(document).ready(function($){
                         var gallery = $("a.colorbox-pic").colorbox();
                         $("a#openGallery").click(function(e){
                             e.preventDefault();
                             gallery.eq(0).click();
                         });
                     });
                 </script>
         </div>
         <div class="clearfix"></div>
     </div>
    <div class="clearfix"></div>




     <!-- days container -->
     <div id="myDay">
         @foreach($itinerary->days($is_preview)->orderby('day_of_itinerary')->get() as $day)

             @if(!$is_preview && $itinerary->user_id == Auth::user()->id && $itinerary->published == 0)
                 {!! Form::model($day,['route'=>['itinerary-day.edit', $day], 'method'=>'GET','class'=>'pull-left']) !!}
                 {{-- send day_of _itinerary thru hidden form --}}
                <div class="top-buffer">
                    {!! Form::submit('Edit This Day', ['class'=>'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}
            @endif

            <div class="clearfix"></div>

            <div class="itiday-box top-buffer" id="day_{!! $day->day_of_itinerary !!}">

                <span class="day-number">{!! 'DAY ' . $day->day_of_itinerary !!}</span>
                <h2>
                    {!! $day->title !!}
                </h2>
                <div class="row">
                    <div class=" pv-day-image-box col-sm-8 col-xs-12">

                        @if( $day->image != null )
                            <img src="{{ env('IMAGE_ROOT') .$day->image }}">
                        @else
                            <span></span>
                        @endif
                    </div>
                    <div class="pv-day-info-block col-sm-4 col-xs-12">
                        <h4 class="pv-day-feat-header"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Places to visit: </h4>
                        <ol class="">
                            @foreach( explode(',', $day->places) as $p)
                                <li>{{ $p }}</li>
                            @endforeach
                        </ol>


                        <h4 class="top-buffer pv-day-feat-header"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Experiences: </h4>
                        <ul class="list-unstyled">
                            @foreach($day->getTopExpNames() as $exp)
                                <li>{{ $exp->experience }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- row -->
                <div class="top-buffer col-md-6 col-md-offset-3 col-xs-12">
                    <p>{{ $day->intro}}</p>
                </div>
            </div>

            <div class="top-buffer">

                <article class="pv-day-content col-sm-10  col-sm-offset-1 col-xs-12">
                    {!! $day->summary !!}
                </article>
            </div>
            <div class="clearfix"></div>
        @endforeach  {{-- end Day foreach --}}
    </div><!-- #myDay -->

    <script>
        jQuery('a.colorbox-pic').colorbox({
            rel: 'colorbox-pic',
            transition:"none",
            opacity:0.60,
            innerWidth: '70%',
            innerHeight: '60%'
        });
    </script>

