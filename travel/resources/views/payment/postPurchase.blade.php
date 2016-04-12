@extends('app')

@section('meta-og')
    <meta property="og:url"                content="{{ route('itinerary.show',$itinerary) }}">
    <meta property="og:type"               content="article">
    <meta property="og:title"              content="{{ 'I just bought: \''.$itinerary->title. '\' from TripPlanShop.com' }}">
    <meta property="og:description"        content="{{ $itinerary->summary }}">
    <meta property="og:image"              content="{{ preg_replace('/ /', '%20', url( env('IMAGE_ROOT') .$itinerary->image))  }}">
    <meta property="fb:app_id"             content="{{ env('FB_CLIENT_ID') }}"
@stop

@section('content')
    <div class="container">
        <div class="row screen-height">

            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 col-xs-12 order-container">
                    <div class="order-header">
                        <p>Thanks for Your Purchase</p>
                    </div>

                    <div  class="order-summary">
                        <p>
                            Hi {{Auth::user()->name}},<br><br>
                            <i><b>{{$itinerary->title }} </b></i> has been added to your purchase list and you
                            can view the whole itinerary from <a href="{{ route('user.purchasedList', Auth::user()) }}">your purchase list</a>
                        </p>
                        <p>
                            Your order number is: <i><b>{{ $transaction_id }}</b></i>. An order confirmation has also been sent to your email, {{Auth::user()->email}}
                        </p>

                        <p>We hope you have a wonderful trip from start to the end. </p>
                        <p>Please leave a review on the itinerary when you come back.</p>

                        <!--<p class="top-buffer">share this with your friend!</p>
                         Go to www.addthis.com/dashboard to customize your tools -->
                        <!-- <div class="addthis_sharing_toolbox"></div> -->
                    </div>
                </div>

            </div>

            </div>

    </div>
@stop