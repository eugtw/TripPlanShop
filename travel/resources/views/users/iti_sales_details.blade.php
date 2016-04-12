@extends('app')

@section('content')
    <div class="container screen-height">
        <div class="row">
            <div class="top-buffer screen-height page-background col-xs-12 col-sm-10 col-sm-offset-1">
                <h2 class="page-header">{{ $itinerary->title }} </h2>



                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Order number</th>
                            <th>Price</th>
                            <th>Buyer</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($itinerary->transactions()->orderby('created_at', 'desc')->get() as $tDetails)
                        <tr>
                            <td>{{ $tDetails->pivot->created_at->format("Y-M-d") }}</td>
                            <td>{{ $tDetails->pivot->id }}</td>
                            <td>{{ '$' . $tDetails->pivot->purchase_price }}</td>
                            <td>{{ $tDetails->name }}</td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div><!-- container -->
@stop