@extends('app', ['title' => 'How To Make Your Trip Plan A Cash Machine'])

@section('meta-description')
    <meta name="description" content="TripPlanShop is a marketplace for travel lovers to buy and sell trip plans around the world. Users can find detailed itineraries in any styles. TripPlanShop is the easiest way to monetize well planned itineraries.">
@stop

@section('content')

    <div class="container top-buffer">
        <div class="row">
            <div class="col-xs-12">
                    <h1>More About Selling Trip Plans</h1>
                    <p>You can monetize your trip plans and travel experiences. Create travel itineraries boasting your travel personality and specialty for any types of trips and events. Sell them to the world. </p>
            </div>
        </div><!-- row -->

        <div class="row">
            <aside class="col-sm-3 col-xs-12" id="becoming-seller">
                <nav>
                    <h2>Getting Started</h2>
                    <ul class="list-unstyled">
                        <li><a href="#become-a-seller">Become Seller</a></li>
                        <li><a href="#set-up-stripe">Set Up Stripe Account</a></li>
                        <li><a href="#review-profile">Review Profile</a></li>
                    </ul>

                    <h2>Create and Sell Your Trip Plans</h2>
                    <ul class="list-unstyled">
                        <li><a href="#things-to-know">Things to Know Before Selling</a></li>
                        <li><a href="#create-trip-plans">Create Trip Plans</a></li>
                        <li><a href="#embed-google-maps">Embed Google Maps</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#getting-paid">Get Paid</a></li>
                    </ul>
                </nav>
            </aside>

            <div class="col-sm-9 col-xs-12" id="becoming-seller-details">
                <div id="become-a-seller">
                    <h2>Join & Become a Seller</h2>
                    <p>It is free to join and list your trip plans at TripPlanShop. Members can buy and sell trip plans. Click “Become seller” to start.
                    </p>
                </div>

                <div id="set-up-stripe">
                    <h2>Set Up Stripe Account</h2>

                    <p>After Stripe sign-up, you need to “activate” your stripe account to proceed. For account
                        details, use "www.tripplanshop.com" for website and "TripPlanShop" for business name.</p>
                    <div class="top-buffer bottom-buffer">
                        <img class="img-responsive" src="/images/site/becoming-seller/stripe-set-up.jpg">
                    </div>
                    <h3>More About Stripe</h3>
                    <p>All transactions at TripPlanShop are processed by Stripe. Stripe processes billions of dollars a year for thousands of businesses. Web and mobile businesses
                        around the world using Stripe include Twitter, Kickstarter, Shopify, Salesforce, Lyft, and many more.
                        Stripe, the company has received around $300 million in funding to date; investors include Sequoia Capital,
                        Visa, American Express, PayPal co-founders Peter Thiel, Max Levchin, and Elon Musk.
                    </p>
                </div>

                <div id="review-profile">
                    <h2>Review Profile</h2>
                    <p>Other users can access your profile through your trip plans, and users can view your other
                        published trip plans on the profile page. Talk about yourself, travel styles, your
                        websites, and any travel services you offer.</p>
                </div>
                <div id="things-to-know">
                    <h2>Things to Know Before Selling</h2>
                    <p>Before purchasing trip plans, users can preview full contents up to the 1st day.
                        Buyers have access of the trip plans for 6 months after purchase.
                        To delete any published trip plans, you need to unpublish them and wait until all purchases expire.
                        ***Even after you "unpublish" a trip plan, users who already purchased it can still access it.***</p>
                </div>
                <div id="create-trip-plans">
                    <h2>Create Trip Plans</h2>
                    <p>You can create trip plans for any type of travels and events. Create trip plans in
                        specific travel styles you prefer, and use style tags to target the right audience.
                        Each trip plan is expected to help users travel without much more planning. </p>
                    <h3>Publish & Edit</h3>
                    <p>Before publishing trip plans, You can view saved trip plans in "plans in progress" under "My Trip Plans".
                    To edit a published trip plan, you need to "unpublish" it and edit.</p>
                </div>
                <div id="embed-google-maps">
                    <h2>Embed Google Maps</h2>
                    <p>Google My Maps Help: <a target="_blank" href="https://support.google.com/mymaps/answer/4708605?hl=en">https://support.google.com/mymaps/answer/4708605?hl=en</a></p>
                    <ol>
                        <li>Choose “public on the web” in sharing settings</li>
                        <li>Click “embed on my site”</li>
                        <li>In the box that appears, copy the HTML, and paste it into the source code for your page</li>
                    </ol>

                    <p>Insert Source Code</p>
                    <ol>
                        <li>Click “Source”</li>
                        <li>“Ctrl + F” to search key words near where you want to put a map</li>
                        <li>Paste HTML into the source code</li>
                    </ol>
                    <div class="bottom-buffer">
                        <img class="img-responsive" src="/images/site/becoming-seller/source-code-insert.jpg">
                    </div>
                </div>
                <div id="pricing">
                    <h2>Pricing</h2>
                    <p>Sellers choose the price for each itinerary from our pricing selection.
                        free or ${{env('ITI_MIN_PRICE')}} -   ${{env('ITI_MAX_PRICE')}} (all taxes included)</p>
                    <p>Becoming a member is free and you get charged only when you earn money from sales.
                        Stripe has no setup fees, no monthly fees, or no card storage fees.
                        When successful sales complete, you get charged total 8% + 60¢ (Stripe and TripPlanShop together)
                    </p>
                </div>

                <div id="getting-paid">
                    <h2>Getting Paid</h2>
                    <p>Stripe has full control of online sales transaction at TripPlanShop. Stripe accepts credit card payments
                        and transfers funds to your bank account based on the schedule listed in your dashboard. You can see all
                        transfers Stripe attempts to your bank account on your dashboard. Your transfer schedule can be configured
                        to simplify your accounting. Funds can be transferred daily, weekly (on a custom day of the week), or monthly
                        (on a custom day of the month). For more information, visit Stripe. https://stripe.com/help/transfers
                    </p>
                    <div class="bottom-buffer">
                        <img class="img-responsive" src="/images/site/becoming-seller/getting paid.jpg">
                    </div>
                </div>

            </div>

            @if(Auth::check() && Auth::user()->stripe_active == 0)
            <div class="text-center col-xs-12">
                <a class="btn-primary pv-footer-button" href="{{ route('user.stripeSignup') }}" role="button">Become Seller</a>
            </div>
            @endif

        </div><!-- row -->

    </div><!-- container -->

@stop