@extends('app', ['title' => 'Confirm Itinerary Purchase Details - TripPlanShop'])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 order-summary-div">
                <h1>Order Summary</h1>
                <p>By placing your order, you agree to TripPlanShop.com's privacy policy and terms of use</p>
            </div>


            <div class="col-md-4 col-sm-6 col-xs-12 same-height">
                <div class="order-summary-iti-container ">
                @include('itinerary.partial_ItineraryDisplay', ['is_preview'=>0])
                </div>
            </div>

            <!-- details -->
            <div class="col-md-8 col-sm-6 col-xs-12 prepurchase-details same-height">
                <form action="{{ route('itinerary.purchase', $itinerary->slug) }}" method="POST" class="form">

                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <tbody>
                            <tr>
                                <td>
                                    Title:
                                </td>
                                <td class="text-left">
                                    {{ $itinerary->title }}
                                </td>
                            </tr>
                            <tr>
                                <td>Seller:</td>
                                <td><a href="{{ route('user.show', $itinerary->user) }}" target="_blank">{{ $itinerary->user->name }}</a></td>
                            </tr>
                            <tr>
                                <td>Price:</td>
                                <td>
                                    US ${{ $itinerary->price }}
                                </td>
                            </tr>
                            <tr>
                                <td>Payment:</td>
                                <td>
                                    credit card
                                    <img class="stripe_power" src="{{ env('SITE_IMAGE_PATH') . 'powered_by_stripe.png'}}"
                                </td>
                            </tr>
                            <tr>
                                <td>About Purchase</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="prepurchase-notes">
                                    <p>* After purchase, you can access the full version of itineraries in 'Purchased Trip Plans' under 'My Trip Plans'</p>
                                    <p>* No refund on any trip plan purchase</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <div class="text-left inline-block">
                            <p>Total: USD ${{ $itinerary->price }}</p>

                            <script
                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="{{ env('STRIPE_PUBLISHABLE_KEY') }}"
                                    data-image="{{ env('STRIPE_PAY_IMG') }}"
                                    data-name="TripPlanShop"
                                    data-description="{{$itinerary->title}}"
                                    data-currency="usd"
                                    data-amount="{{$itinerary->price*100}}"
                                    data-locale="auto"
                                    data-email="{{Auth::user()->email}}">
                            </script>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
    <script>
        jQuery(function(){
            $('.same-height').matchHeight();
        });
    </script>
@stop