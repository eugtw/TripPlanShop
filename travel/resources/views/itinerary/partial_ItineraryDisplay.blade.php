<div class="iti-card-container">
    <div class="iti-day"><span>{{ $itinerary->days()->count()}}</span>
        <span>DAY{{ ($itinerary->days()->count() > 1) ? 'S' :  ''}}</span>
    </div>

    <a href="{{ route('itinerary.show',$itinerary) }}">
        <div class="iti-card-image" id="{{'iti-card-' . $itinerary->getRouteKey()}}">
            {{-- feature image in background --}}
        </div><!-- .pop-itit-dis-box -->
    </a>

    @include('includes.iti_purchase_block')



    <div class="col-xs-12">
        <div class="iti-card-title">
            <a href="{{ route('itinerary.show',$itinerary) }}">{{ $itinerary->title }}</a>
        </div>

        <ul class="list-inline">
            @foreach($itinerary->styles as $s)
                <li class="iti-card-style"><a href="{{'/itinerary-search?style_list='.$s->style}}"><span>#</span>{{$s->style }}</a></li>
            @endforeach
        </ul>
        <div class="clearfix"></div>

        <ul class="list-inline iti-card-city">
            <span>Cit{{ ($itinerary->cities()->count() > 1) ? 'ies' :  'y'}}:</span>
            @foreach($itinerary->cities as $c)
                <li><a href="{{'/itinerary-search?location='.$c->city}}">{{ $c->city }}</a></li>
            @endforeach
        </ul>

        <div class="iti-author">
            <div class="iti-card-author-info">
                <a class="name" target="_blank" href="{{ route('user.show', $itinerary->user) }}">
                    <i>{{$itinerary->user->name }}</i>
                </a>

                @if(isset($itinerary->user->profile->blog_link) && !is_null($itinerary->user->profile->blog_link) )
                    <span class="iti-author-blog"> | </span>
                    <a class="iti-author-blog" href="">
                        {{ $itinerary->user->profile->blog_link }}
                    </a>
                @endif
            </div>

        </div>

        <div class="iti-footer">

            @include('includes.inc-review')

            <div id="see-details-link">
                <a class="theme-blue" href="{{ route('itinerary.show',$itinerary) }}">See Details</a>
            </div>
        </div><!-- pop-itit-container-footer -->
    </div><!-- col-xs-12 -->

    <div class="clearfix"></div>
    <script>
        //add/delete item to/from favorite list
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

    <script>
        //background image replacement
        var image_url = '{{url(env('IMAGE_ROOT') .$itinerary->image)}}';
        jQuery.ajax({
            url: image_url,
            type: "HEAD",
            success: function(){
                jQuery("#" + "{{'iti-card-' . $itinerary->getRouteKey() }}" ).css('background-image',
                        'url("{{ env('IMAGE_ROOT') .$itinerary->image }} ")');
            }
        });
    </script>
</div>

<!-- review Modal -->
@include('itinerary.review_modal')