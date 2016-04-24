@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                <image class="col-sm-2 col-xs-3 img-circle img-responsive" src="{{$user->profile->avatar==null  ? env('USER_AVATAR_PATH') . 'default_user.jpg' : $user->profile->avatar}}"></image>
                <span>Joined since: {{$user->created_at->toFormattedDateString()}}</span>
                <ul>
                    <a class="btn" href="{{ route('user.edit',$user) }}"><li>Edit Profile</li></a>
                </ul>
            </div>
            <div class="col-xs-9">

            </div>
        </div>
    </div>


    <div class="container">
        <h2 class="page-header inline-block">Profile</h2>
        @if(Auth::check() && Auth::user()->id == $user->id)
            <a class="btn" href="{{ route('user.edit',$user) }}"> Edit</a>
        @endif
        <div class="clearfix"></div>
        <image class="col-sm-2 col-xs-3 img-circle img-responsive" src="{{$user->profile->avatar==null  ? env('USER_AVATAR_PATH') . 'default_user.jpg' : $user->profile->avatar}}"></image>
        <div class="col-sm-6 col-sm-offset-1">
            <table class="table">
                <tr>
                    <td>username:</td>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <td>website:</td>
                    <td><a href="{{url($user->profile->blog_link)}}" target="_blank">{{$user->profile->blog_link}}</a></td>
                </tr>
                @if(Auth::check() && Auth::user()->id == $user->id)
                    <tr>
                        <td>email: </td>
                        <td>{{$user->email}}</td>
                    </tr>
                @endif
                <tr>
                    <td>joined since: </td>
                    <td>{{$user->created_at->toFormattedDateString()}}</td>
                </tr>
            </table>
        </div><!-- col-sm-6 col-sm-offset-1 -->
        <div class="clearfix"></div>
        @if($user->stripe_active == 1)
            <h3>Published Trip Plans</h3>
            <ul>
                <li><a href="{{ route('user.getPublished',$user) }}">published
                        {{' ('. $user->itineraries()->where('published','=','1')->count() .')'}}</a></li>
            </ul>
        @endif
        @if(Auth::check() && Auth::user()->id == $user->id)
            <h3>My Trip Plans</h3>
            <ul>
                @if(Auth::user()->id == $user->id)
                    <li><a href="{{ route('user.liked', [Auth::user()]) }}">Wish List
                            {{' ('. \App\Itinerary::whereliked()->count() .')' }}</a></li>

                    <li><a href="{{ route('user.purchasedList', [Auth::user()]) }}">Plans for Viewing
                            {{' (' . $user->transactions()->where('transactions.user_id',$user->id)->count() . ')'}}</a></li>


                    @if(Auth::user()->stripe_active == 1)
                        <li><a href="{{ route('user.getInProgress', [Auth::user()]) }}">Plans in Progress
                                {{' ('. $user->itineraries()->where('published','=','0')->count() .')' }}</a></li>
                    @endif

                @endif

            </ul>

            <h3>Tools</h3>
            <ul>
                <li><a href="{{ route('user.edit', [Auth::user()]) }}">Edit Profile</a></li>
                <li>
                    <a class="popup_selector" data-inputid="image">My Photo Gallery</a>
                </li>

                @if(Auth::user()->stripe_active)
                    <li><a href="{{ route('itinerary.create') }}">Create Trip Plan</a></li>
                    <li><a href="https://dashboard.stripe.com/login" target="_blank">Stripe Login</a></li>
                @endif
            </ul>
        @endif

        <h3>About me:</h3>
        <p>{{  is_null($user->profile) ? 'n/a' : $user->profile->about_yourself }}</p>
        <h3>Travel Style:</h3>
        <p>{{   is_null($user->profile) ? 'n/a' : $user->profile->travel_style }}</p>

        <script src="{{ asset('/packages/barryvdh/elfinder/js/standalonepopup.js') }}">
            //standalone elfinder
        </script>
    </div><!-- container -->
@stop