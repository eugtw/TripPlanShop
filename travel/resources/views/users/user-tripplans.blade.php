@extends('app')
@section('content')
    <div class="container screen-height">
        <div class="row">
            <h1 class="col-xs-12 bottom-buffer top-buffer2">{{ $title }}</h1>

            @foreach($itineraries as $key => $itinerary)
                <div class="col-md-4 col-sm-6 col-xs-12 iti_card bottom-buffer">
                    <div class="pop-itit-container">
                        @include('itinerary.partial_ItineraryDisplay', ["is_preview"=>$is_preview, 'key'=>$key])
                    </div>

                    @if(isset($plan_in_progress_page))
                        <button class="iti-delete" data-href="{{ route('itinerary.iti-delete', $itinerary->slug) }}" data-toggle="modal" data-target="#confirm-delete">
                            <i class="fa fa-trash-o"></i> Delete
                        </button>

                        <div class="inline-block">
                            <form action="{{ route('itinerary.publish', $itinerary->slug) }}", method="GET">
                                <button type="submit" class="iti-publish" data-href="">
                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i> Publish
                                </button>
                            </form>
                        </div>

                     @endif
                </div>
            @endforeach
        </div>

        {{-- confirm modal --}}
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        Do you want to delete this itinerary?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger btn-ok">Delete</a>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <script>
        jQuery(function(){
            $('.iti_card').matchHeight();
        });

        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
@stop