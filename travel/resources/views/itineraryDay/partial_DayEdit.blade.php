<article  data-place-id = "{{ $place->id }}" data-place-edit = "1">

    <div class="inner-wrap">


        {{-- dropzone --}}
        <form action="{{ route('itidayplace.storePlaceImage') }}"
              method="POST"
              class="dropzone"
              name ="place_image"
              id="dropzone-{{ $place->id }}">
            <div class="fallback">
                <input name="place_image" type="file" multiple />
            </div>
            <input name="place_id" value="{{ $place->id }}" type="hidden">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>

        {{-- display photos already saved for editing --}}
        @if( $place->image_path != '')
            <div class="day-photo-thumbs inline-block">
                <a href="{{ route('itidayplace.deletePlaceImage', $place->id)}}" data-place-img-delete = "data-place-img-delete" data-pId = "{{ $place->id }}">
                    <i class="fa fa-times delete-btn" aria-hidden="true"></i>
                </a>
                <img class="thumbnail" src="{{ asset($place->image_path) }}" alt="{{ $place->place_title }}}}">
            </div>
            <div class="clearfix"></div>
        @endif



        {!! Form::model($place, [
                'route' => ['itinerary-day.day-place.update', $place->id],
                'method' => 'PATCH',
                'class' => "ajaxForm pid-$place->id"]) !!}


        <!-- day google map input -->
        @include('includes.dayPlaceMap')


        {!! Form::label('loc_lat', null, ['class'=>'sr-only']) !!}
        {!! Form::text('loc_lat', null, ['hidden'=>'hidden', 'id' => 'place-'.$place->id.'-lat']) !!}
        {!! Form::label('loc_lng', null, ['class'=>'sr-only']) !!}
        {!! Form::text('loc_lng', null, ['hidden'=>'hidden', 'id' => 'place-'.$place->id.'-lng']) !!}
        {!! Form::label('place_address', null, ['class'=>'sr-only']) !!}
        {!! Form::text('place_address', null, ['hidden'=>'hidden', 'id' => 'place-'.$place->id.'-formatted_address']) !!}
        {!! Form::label('website', null, ['class'=>'sr-only']) !!}
        {!! Form::text('website', null, ['hidden'=>'hidden', 'id' => 'place-'.$place->id.'-website']) !!}
        {!! Form::label('photo_ref_google', null, ['class'=>'sr-only']) !!}
        {!! Form::text('photo_ref_google', null, ['hidden'=>'hidden', 'id' => 'place-'.$place->id.'-photo_ref_google']) !!}

        <div class="row">

            <ul class="route-detail-table list-unstyled">
                <li class="col-xs-12">
                    <div class="form-group row">
                        {!! Form::label('place_title', 'Title', ['class'=>'control-label col-xs-4']) !!}
                        <div class="col-xs-8">
                            {!! Form::text('place_title', null, ['placeholder' => 'Place Title','class'=>'form-control',
                                                                'id' => 'place_title']) !!}
                        </div>
                    </div>
                </li>
                <li class="col-xs-12">
                    <div class="form-group row">
                        {!! Form::label('business_hours', 'Business hours', ['class'=>'control-label col-xs-4']) !!}
                        <div class="col-xs-8">
                            {!! Form::textarea('business_hours', null, ['placeholder' => 'eg: mon - fri, 8am - 6am','class'=>'form-control', "maxlength"=>"20", 'data-place-id' => $place->id]) !!}
                        </div>
                    </div>
                </li>
                <hr class="col-xs-12">
                <li class="col-xs-12">
                    <div class="form-group row">
                        {!! Form::label('time_to_visit', 'Best time to visit', ['class'=>'control-label col-xs-4', ]) !!}
                        <div class="col-xs-8">
                            {!! Form::text('time_to_visit', null, ['placeholder' => 'eg: 2pm or afternoon','class'=>'form-control', "maxlength"=>"20"]) !!}
                        </div>
                    </div>
                </li>
                <li  class="col-xs-12">
                    <div class="form-group row">
                        {!! Form::label('duration', 'Duration', ['class'=>'control-label col-xs-4', ]) !!}
                        <div class="col-xs-8">
                            {!! Form::select('duration', $duration, null, ['placeholder' => 'eg: 3 hours','class'=>'form-control']) !!}
                        </div>
                    </div>
                </li>
                <li  class="col-xs-12">
                    <div class="form-group row">
                        {!! Form::label('public_transit', 'Suggested transportation', ['class'=>'control-label col-xs-4', ]) !!}
                        <div class="col-xs-8">
                            {!! Form::select('public_transit', $transit_methods,  null, ['placeholder' => 'eg: yes/no','class'=>'form-control']) !!}
                        </div>
                    </div>
                </li>
                <li  class="col-xs-12">
                    <div class="form-group row">
                        {!! Form::label('experiences', 'Experiences', ['class'=>'control-label col-xs-4', ]) !!}
                        <div class="col-xs-8">
                            {!! Form::select('experiences[]', $experiences, null,
                            ['multiple' => 'multiple', 'placeholder' => 'category','class'=>'form-control select2', 'id' => "exp_place_" , 'data-max-selected' => '2']) !!}
                        </div>
                    </div>
                </li>
            </ul>

        </div>


        <div>
            <div class="form-group">
                {!! Form::label('place_intro', 'Intro', ['class'=>'control-label']) !!}
                <button class="btn-formToggle" type="button" data-toggle="collapse" data-target="#collapseIntro-{{$place->id}}" aria-expanded="false" aria-controls="collapseExample">
                    open/close form
                </button>
                <div class="collapse" id="collapseIntro-{{$place->id}}">
                    {!! Form::textarea('place_intro', null,
                    ['placeholder' => 'place introduction', 'rows'=>'5','class'=>'form-control editor', 'id' => $place->id .'place_intro']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('to_do', 'What to do(optional)', ['class'=>'control-label']) !!}
                <button class="btn-formToggle" type="button" data-toggle="collapse" data-target="#collapseToDo-{{$place->id}}" aria-expanded="false" aria-controls="collapseExample">
                    open/close form
                </button>
                <div class="collapse" id="collapseToDo-{{$place->id}}">
                    {!! Form::textarea('to_do', null,
                    ['placeholder' => 'what to do', 'rows'=>'5','class'=>'form-control editor', 'id' => $place->id .'to_do']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('tips', 'Helpful tips(optional)', ['class'=>'control-label']) !!}
                <button class="btn-formToggle" type="button" data-toggle="collapse" data-target="#collapseTips-{{$place->id}}" aria-expanded="false" aria-controls="collapseExample">
                    open/close form
                </button>
                <div class="collapse" id="collapseTips-{{$place->id}}">
                    {!! Form::textarea('tips', null,
                    ['placeholder' => 'Helpful tips', 'rows'=>'5','class'=>'form-control editor', 'id' => $place->id .'tips']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('transportation', 'Transportation plan(optional)', ['class'=>'control-label']) !!}
                <button class="btn-formToggle" type="button" data-toggle="collapse" data-target="#collapseTran-{{$place->id}}" aria-expanded="false" aria-controls="collapseExample">
                    open/close form
                </button>
                <div class="collapse" id="collapseTran-{{$place->id}}">
                    {!! Form::textarea('transportation', null,
                    ['placeholder' => 'how to get to this place', 'rows'=>'5','class'=>'form-control editor', 'id' => $place->id .'transportation']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('restaurants', 'Nearby food/restaurants(optional)', ['class'=>'control-label']) !!}
                <button class="btn-formToggle" type="button" data-toggle="collapse" data-target="#collapseRest-{{$place->id}}" aria-expanded="false" aria-controls="collapseExample">
                    open/close form
                </button>
                <div class="collapse" id="collapseRest-{{$place->id}}">
                    {!! Form::textarea('restaurants', null,
                    ['placeholder' => 'restaurants recommendation', 'rows'=>'5','class'=>'form-control editor', 'id' => $place->id .'restaurants']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('info_links', 'Info websites(optional)', ['class'=>'control-label']) !!}
                <button class="btn-formToggle" type="button" data-toggle="collapse" data-target="#collapseInfoLinks-{{$place->id}}" aria-expanded="false" aria-controls="collapseExample">
                    open/close form
                </button>
                <div class="collapse" id="collapseInfoLinks-{{$place->id}}">
                    {!! Form::textarea('info_links', null,
                    ['placeholder' => 'links for information', 'rows'=>'5','class'=>'form-control editor', 'id' => $place->id .'info_links']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="top-buffer">
                    {!! Form::submit('Save', ['class'=>'btn itit-footer-button btn-primary sr-only']) !!}
                </div>
            </div>
        </div>


        {!! Form::close() !!}
    </div>


    <script>

        $(document).ready(function(){

            $('a[data-place-img-delete]').click(function(e){

                e.preventDefault();

                var pId = $(this).data('pid');
                var url = $(this).attr('href');
                var element = $(this);

                var $body = $("body");
                $body.addClass("loading");

                $.get(url, function(data) {
                    element.parent().fadeOut();
                    $('.place-nav-img.place-' + pId).attr('src', data['photo_ref_google']);
                }).fail(function() {
                    alert('error! please try again');
                }).always(function() {
                    $body.removeClass("loading");
                });

            });
        });

    </script>
</article><!-- #day -->