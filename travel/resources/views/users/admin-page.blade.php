@extends('app')

@section('content')
    <div class="container">
        <div class="row page-background top-buffer">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 top-buffer">

                @if(Auth::check() && $user->id == Auth::user()->id)
                {!! Form::model($user,['route'=>['user.edit', $user], 'method'=>'GET','class'=>'pull-left']) !!}
                <div class="bottom-buffer">
                    {!! Form::submit('Edit Profile', ['class'=>'btn btn-info']) !!}
                </div>
                {!! Form::close() !!}
                @endif

                <div class="clearfix"></div>

                <div class="col-xs-12 col-sm-3">
                    <image class="img-circle img-responsive" src="{{$user->profile->avatar==null  ? env('USER_AVATAR_PATH') . 'default_user.jpg' : $user->profile->avatar}}">
                </div>
                <div class="col-xs-12 col-sm-9">
                    <table class="table">
                        <tr>
                            <td>username:</td>
                            <td>{{$user->name}}</td>
                        </tr>
                        @if($user->profile->blog_link != '' )
                            <tr>
                                <td>website:</td>
                                <td><a href="{{url($user->profile->blog_link)}}" target="_blank">{{$user->profile->blog_link}}</a></td>
                            </tr>
                        @endif
                        @if(Auth::check() && $user->stripe_active == 1 )
                            <tr>
                                <td>Contact email: </td>
                                <td>{{$user->profile->contact_email}}</td>
                            </tr>
                        @endif

                        <tr>
                            <td>joined since: </td>
                            <td>{{$user->created_at->toFormattedDateString()}}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-xs-12 col-sm-10 col-sm-offset-1 top-buffer">
                <h3>About Me:</h3>
                <p>{{  is_null($user->profile) ? 'n/a' : $user->profile->about_yourself }}</p>
            </div>


            <div class="col-xs-12 col-sm-10 col-sm-offset-1 top-buffer bottom-buffer2">
                <h3>Travel Style:</h3>
                <p>{{   is_null($user->profile) ? 'n/a' : $user->profile->travel_style }}</p>
            </div>
        </div><!-- row -->


        <div class="row">
            <!-- published itit -->
            @if(!$published_iti->isEmpty())
            <h3 class="top-buffer2 text-center">Published Itineraries</h3>
            @endif
            @foreach($published_iti as $key =>  $itinerary)
                <div class="col-sm-4 col-xs-12 iti_card bottom-buffer">
                        @include('itinerary.partial_ItineraryDisplay', ["is_preview"=>1, 'key'=>$key])
                </div>
                <script>
                    jQuery(function(){
                        $('.iti_card').matchHeight();
                    });
                </script>
            @endforeach
        </div>

        <div class="text-center">
            {!! $published_iti->render() !!}
        </div>
    </div><!-- container -->
@stop