<hr class="top-buffer">
<div class="text-center top-buffer">

    @if($is_preview)
        @if($itinerary->price == 0)
            <a type="button"
               class="itit-button itit-footer-button btn-primary"
               href="{{ route('itinerary.getItiFree', $itinerary->slug) }}">Add To List For Free</a>
        @else
            <a type="button"
               class="itit-button itit-footer-button btn-primary"
               href="{{ route('itinerary.purchaseConfirm', $itinerary->slug) }}">BUY FULL ITINERARY</a>
        @endif
    @elseif($itinerary->user_id == Auth::user()->id)
        @if($itinerary->published != env("ITI_PUBLISHED"))
            {{--- not published yet? show "add more days" button" and "publish" button ---}}
            <div class="day-create-container text-center">
                {!! Form::open(['route'=>'itinerary-day.create','method'=>'GET']) !!}
                {!! Form::hidden('iti_id', Crypt::encrypt($itinerary->id)) !!}
                {!! Form::submit('Add Day', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        @endif
        <div class="top-buffer">
            @if($itinerary->published == env("ITI_PUBLISHED"))
                <a type="button" class="btn btn-primary text-center" href="{{route('itinerary.unpublish',$itinerary->slug)}}">
                    Unpublish Itinerary
                </a>
            @else
                {{-- cannot publich if iti doesnt have even 1 day details--}}
                @if($itinerary->days->count() >= 1)
                    <a type="button" class="itit-footer-button itit-btn btn-primary text-center top-buffer" href="{{route('itinerary.publish',[$itinerary->slug])}}">
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