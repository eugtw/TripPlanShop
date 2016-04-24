@extends('app')

@section('content')
    <div class="container top-buffer">
        <h2>My Trip Plans</h2>

        <ul class="list-unstyled">
            @if(Auth::user()->id == $user->id)
                <li><a href="{{ route('user.liked', [Auth::user()]) }}">Wish List
                        {{' ('. \App\Itinerary::whereliked()->count() .')' }}</a></li>

                <li><a href="{{ route('user.purchasedList', [Auth::user()]) }}">Plans for Viewing
                        {{' (' . $user->transactions()->where('transactions.user_id',$user->id)->count() . ')'}}</a></li>


                @if(Auth::user()->stripe_active == 1)
                    <li><a href="{{ route('user.getPublished',[Auth::user()]) }}">Published Plans & Sales
                            {{' ('. $user->itineraries()->where('published','=', env('ITI_PUBLISHED'))->count() .')'}}</a></li>

                    <li><a href="{{ route('user.getInProgress', [Auth::user()]) }}">Plans in Progress
                        {{' ('. $user->itineraries()->where('published','=',env('ITI_NOT_PUBLISHED'))->count() .')' }}</a></li>
                @endif
            @endif
        </ul>
    </div><!-- container -->
@stop