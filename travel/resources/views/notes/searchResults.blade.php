@extends('app', ['title'=> 'Find Trip Plans Fit You'])

@section('content')

    <header>
        <div class="container" id="header-search-box">
            <div class="row">
                <div id="searchpage-searchbox" class="col-sm-8 col-sm-offset-2 col-xs-12">
                    {!! Form::open(['url'=>'itinerary/search','class'=>'form']) !!}
                    <div class="input-group">
                        {!! Form::label('location', null,['class'=>'sr-only']) !!}
                        {!! Form::text('location', null,['placeholder'=>'Where to go?','class'=>'form-control input-lg', 'id' => 'autocomplete', 'onFocus'=>'geolocate()']) !!}
                        <span class="input-group-btn" style="width:0px;"></span>
                        {!! Form::label('style_list', 'Style Select',['class'=>'sr-only']) !!}
                        {!! Form::select('style_list', (['any'=>'style'] +$styles), 1,['style'=>'margin-left:-1px', 'class'=>'form-control input-lg', 'id'=>'style_list']) !!}
                        <span class="input-group-btn" style="width:0px;"></span>
						<span class="input-group-btn">
							{!! Form::submit('Search', ['class'=>'btn btn-success input-lg']) !!}
						</span>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        @foreach($itineraries as $itinerary)

            {{-- replace jumbotron div background image --}}
            <script type="text/javascript">
                //replace background for pop-dest-dis-box
                var image = '{{$itinerary->image}}';
                if(image == null)
                {
                    $("#box-{{$itinerary->id}}").css('background-image',
                            'url({{ env('IMAGE_ROOT') . $itinerary->image }} )');
                }
                else{

                }
                /*$.get(image_url)
                        .done(function() {
                            // Do something now you know the image exists.

                        }).fail(function() {
                            // Image doesn't exist - do something else.
                        })

                $(function()
                {
                    $("#box-{{$itinerary->id}}").css('background-image',
                                'url({{ url(env('ITINERARY_COVER_IMAGE_PATH') . $itinerary->image) }} )');
                });*/
            </script>


            <div class="row">
                <div class="jumbotron" id="box-{{$itinerary->id}}">
                    <div class="container">
                        <div class="col-md-8 col-xs-12">
                            <h2>{{$itinerary->title}}</h2>
                            <p>{{$itinerary->summary}}</p>
                        </div>

                        <div class="itinerary-search-result-info col-sm-7 col-xs-12">
                            <div class="col-sm-3 col-xs-12">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <span class="itinerary-search-result-day-stay">{!!$itinerary->days()->count()!!}</span> DAYS
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            <div class="col-sm-3 col-xs-12">
                                    <table class="table" id="tinerary-search-result-table">
                                        <tr>
                                            <td><ul class="list-unstyled">
                                                    @foreach($itinerary->styles as $style)
                                                        <li>{{$style->style}}</li>
                                                    @endforeach
                                                </ul></td>
                                        </tr>
                                    </table>
                                    </div>
                            <div class="col-sm-6 col-xs-12">
                                <table class="table" id="tinerary-search-result-table">
                                        <tr>
                                            <td>
                                                <ul class="list-unstyled">
                                                    @foreach($itinerary->cities as $city)
                                                        <li>{{$city->city . ', ' . $city->country->country}}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    </table>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>

                        <p id="search-result-preview"><a class="btn btn-primary btn-lg" href="/itinerary/{{Crypt::encrypt($itinerary->id)}}" role="button">Preview</a></p>

                       </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container">

        @foreach($itineraries as $itinerary)
            <div class="row">
                <script type="text/javascript">
                    var image = '{{ $itinerary->image }}';
                    if(image == null)
                    {
                        $("#box-{{$itinerary->id}}").css('background-image',
                                'url({{ env('IMAGE_ROOT') . $itinerary->image }} )');
                    }
                    else{
                        //do nothing
                    }
                    /*
                    $(function()
                    {
                        $(".ibox-{{$itinerary->id}}").css('background-image',
                                'url({{ env('ITINERARY_COVER_IMAGE_PATH') . $itinerary->image }} )');
                    });*/
                </script>
                <div class="display-box col-sm-4 col-xs-12">
                    <div class="display-image-box ibox-{{$itinerary->id}}" >
                        <!-- box to be fiiled with background image -->
                        <h3>{{$itinerary->title}}</h3>

                        <a href="{{ route('itinerary.show',$itinerary) }}" role="button">Preview</a></p>
                    </div>
                    <div class="col-xs-12">

                        <p>{{$itinerary->summary}}</p>

                        <div class="col-xs-12">
                            <div class="col-sm-3 col-xs-12">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <span class="itinerary-search-result-day-stay">{!!$itinerary->days()->count()!!}</span> DAYS
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <table class="table" id="tinerary-search-result-table">
                                    <tr>
                                        <td><ul class="list-unstyled">
                                                @foreach($itinerary->styles as $style)
                                                    <li>{{$style->style}}</li>
                                                @endforeach
                                            </ul></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <table class="table" id="tinerary-search-result-table">
                                    <tr>
                                        <td>
                                            <ul class="list-unstyled">
                                                @foreach($itinerary->cities as $city)
                                                    <li>{{$city->city . ', ' . $city->country}}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>

                    </div><!-- col-xs-12 -->

                    <!-- show review in stars -->
                    <span>
                    @if($itinerary->reviews()->count() < 3)
                        {{"New!"}}
                    @else{
                        {{ round($itinerary->reviews()->avg('rating'),1) }}
                    @endif
                    </span>
                    <span class="glyphicon glyphicon-star stars"></span>

                    {!! Form::open() !!}
                    {!! Form::submit('Buy', ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}

                </div><!-- col-sm-4 col-xs-12 -->

            </div><!-- row -->
        @endforeach
    </div>
@endsection
