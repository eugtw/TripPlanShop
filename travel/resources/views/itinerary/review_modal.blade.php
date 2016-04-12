<div class="modal fade" id="reviewModal_{{ $itinerary->getRouteKey() }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Reviews</h4>
            </div>
            <div class="modal-body">

                @if( !Auth::check())
                    {{-- not logged in so show nothging, or not purchased yet  || $itinerary->transactions->where('id',Auth::user()->id)->isEmpty() --}}
                    <p class="text-center">Did you purchase the trip plan? <a href="{{ url('/auth/login') }}">Sign In</a> to make a review or purchase the itinerary.</p>

                @elseif( $itinerary->user->id == Auth::user()->id)
                    {{-- review input form. Only for purchased users --}}
                    <p class="text-center">Check out what people say about your trip plan.</p>

                @elseif($itinerary->transactions->where('id',Auth::user()->id)->isEmpty())
                    {{-- signed in and not purchased --}}
                @elseif( $itinerary->reviews->where('user_id',Auth::user()->id)->isEmpty() )

                    {{-- purhcased itinerary but not yet reviewed --}}
                    <div>
                        {!! Form::open(['route'=>'review.store']) !!}
                        {!! Form::text('itinerary_id', Crypt::encrypt($itinerary->id),['hidden'=>'true']) !!}
                        <div class="form-group">
                            <textarea class="form-control " cols="50"  name="comment" placeholder="Enter your review here..." rows="3" required="true"></textarea>
                        </div>
                        <div class="form-group">

                            <p>Rate this itinerary: </p>
                            <label class="radio-inline">{!! Form::radio('rating', '1', ['required'=>'true']) !!}1</label>
                            <label class="radio-inline">{!! Form::radio('rating', '2', ['required'=>'true']) !!}2</label>
                            <label class="radio-inline">{!! Form::radio('rating', '3', ['required'=>'true']) !!}3</label>
                            <label class="radio-inline">{!! Form::radio('rating', '4', ['required'=>'true']) !!}4</label>
                            <label class="radio-inline">{!! Form::radio('rating', '5', ['required'=>'true']) !!}5</label>


                        </div>
                        <div class="form-group">
                            {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix top-buffer"></div>

                @else
                    <p class="text-center">You already reviewed this itinerary.</p>
                @endif


                @if( $itinerary->reviews->isEmpty() )
                    <p class="text-center">no reviews yet</p>
                @else
                    <hr>
                    @foreach($itinerary->reviews as $r)
                        <div class="user-comment-box">
                            <div class="user-comment-avatar">
                                <img class="img-circle img-responsive" src="{{ (($r->user->profile == null || $r->user->profile->avatar == null)  ? env('USER_AVATAR_PATH') . 'default_user.jpg' : $r->user->profile->avatar) }}">
                            </div>
                            <div class="user-comment-detail col-xs-10">
                                <div class="">
                                    <span class="user-comment-name">{{ $r->user->name}}</span>
                                    <span class="user-detail-seperator">•</span>
                                    <span class="user-comment-date">{{$r->created_at->format("Y-M-d") }}</span>
                                </div>
                                <div>
                                    @for ($i=1; $i <= 5 ; $i++)
                                        <span class="small glyphicon glyphicon-star rating{{ ($i <= $r->rating) ? '' : '-empty'}}"></span>
                                    @endfor
                                </div>
                                <div class=""><p>{{  $r->comment}}</p></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>