@extends('app', ['title' => 'How To Make Your Trip Plan A Cash Machine'])

@section('meta-description')
    <meta name="description" content="TripPlanShop is a marketplace for travel lovers to buy and sell trip plans around the world. Users can find detailed itineraries in any styles. TripPlanShop is the easiest way to monetize well planned itineraries.">
@stop

@section('content')

    <div class="container top-buffer" id="faq-page">


        <div class="row">
            <h1 class="col-xs-12">FAQS</h1>
            <aside class="pull-left">
                <nav>
                    <ul class="list-unstyled">
                        <li><a href="#being-a-member">BEING A MEMBER</a></li>
                        <li><a href="#buying-trip-plans">BUYING TRIP PLANS</a></li>
                        <li><a href="#becoming-a-seller">BECOMING A SELLER</a></li>
                        <li><a href="#creating-trip-plans">CREATING TRIP PLANS</a></li>
                        <li><a href="#pricings">PRICINGS</a></li>
                        <li><a href="#getting-paid">GETTING PAID</a></li>
                        <li><a href="#stripe">STRIPE</a></li>
                    </ul>
                </nav>
            </aside>

            <div class="col-sm-7 col-xs-12">
                <div>
                    <h2 id="being-a-member">BEING A MEMBER</h2>
                    <ul class="list-unstyled">
                        <li><a href="#q1">Are there any fees to join?</a></li>
                        <li><a href="#q3">After I join TripPlanShop, can I sell trip plans?</a></li>
                    </ul>

                    <h2 id="buying-trip-plans">BUYING TRIP PLANS</h2>
                    <ul class="list-unstyled">
                        <li><a href="#q4">What is a "Trip Plan"? What do I get when I purchase one?</a></li>
                        <li><a href="#q5">Where to see my purchased plans?</a></li>
                        <li><a href="#q6">Can I get refunds after I purchase?</a></li>
                        <li><a href="#q7">How can I contact sellers?</a> </li>
                        <li><a href="#q8">Can I change my ratings or comments on trip plans?</a></li>
                        <li><a href="#q9">Where can I see other trip plans created by the same author of the trip plan I purchase?</a> </li>
                    </ul>

                    <h2 id="becoming-a-seller">BECOMING A SELLER<span><small><a href="{{ route('home.getSellerDetails') }}"> see more</a></small></span></h2>
                    <ul class="list-unstyled">
                        <li><a href="#q10">Are there any fees to become a seller?</a></li>
                        <li><a href="#q12">I want to sell my trip plans. How can I become a seller?</a></li>
                        <li><a href="#q13">What is my website and business names in Strip account?</a> </li>
                        <li><a href="#q14">Why should I make Stripe account to sell trip plans at TripPlanShop?</a> </li>
                    </ul>

                    <h2 id="creating-trip-plans">CREATING TRIP PLANS</h2>
                    <ul class="list-unstyled">
                        <li><a href="#q15">What is a “trip plan”?</a></li>
                        <li><a href="#q16">I can’t upload photos to photo gallery.</a></li>
                        <li><a href="#q17">How can I save my unfinished trip plans?</a></li>
                        <li><a href="#q18">Can I edit my published trip plans?</a></li>
                        <li><a href="#q19">Can I delete trip plans I create?</a></li>
                        <li><a href="#q20">How can I insert maps in my trip plans?</a></li>
                        <li><a href="#q22">Facebook share image doesn't update</a></li>
                    </ul>

                    <h2 id="pricings">PRICINGS</h2>
                    <ul class="list-unstyled">
                        <li><a href="#q21">How much does TripPlanShop charge on sales?</a></li>
                        <li><a href="#q24">How about taxes?</a></li>
                    </ul>

                    <h2 id="getting-paid">GETTING PAID</h2>
                    <ul class="list-unstyled">
                        <li><a href="#q25">How can I get paid for sales?</a></li>
                        <li><a href="#q26">Who should I contact for questions about payments and transactions?</a></li>
                    </ul>

                    <h2 id="stripe">STRIPE</h2>
                    <ul class="list-unstyled">
                        <li><a href="#q27">What is Stripe?</a></li>
                    </ul>
                </div>

                <div>
                    <div id="q1" class="faq-answer-list">
                        <h3 >Are there any fees to be a member?</h3>
                        <p>No. Joining TripPlanShop is free. No membership fee or other fees exist.</p>
                    </div>


                    <div id="q3" class="faq-answer-list">
                        <h3>After I join TripPlanShop, can I sell trip plans?</h3>
                        <p>Not yet.  To sell trip plans, you need to apply for becoming a seller. There is no fee to become a seller.</p>
                    </div>

                    <div id="q4" class="faq-answer-list">
                        <h3>What is a "Trip Plan"? What do I get when I purchase one?</h3>
                        <p>Trip plans are detailed itineraries for any types of trips and events like special dates and parties. Contents of each trip plan vary on authors, but trip plans usually include: photos, where to go, what to do, what to see, tips, and useful information.</p>
                    </div>

                    <div id="q5" class="faq-answer-list">
                        <h3>Where to see my purchased plans?</h3>
                        <p>Your purchased trip plans will show up as "Purchased Plans" in <a href="{{ route('user.getAllTripPlans', [Auth::user()]) }}">My Trip Plans</a></p>
                    </div>

                    <div id="q6" class="faq-answer-list">
                        <h3>Can I get refunds after I purchase?</h3>
                        <p>No. We don’t offer refunds at this time.</p>
                    </div>

                    <div id="q7" class="faq-answer-list">
                        <h3>How can I contact sellers?</h3>
                        <p>You can email trip plan author's from profile page.</p>
                    </div>

                    <div id="q8" class="faq-answer-list">
                        <h3>Can I change my ratings or comments on trip plans?</h3>
                        <p>No. Ratings and comments posted on trip plans cannot be edited or deleted.</p>
                    </div>

                    <div id="q9" class="faq-answer-list">
                        <h3>Where can I see other trip plans created by the same author of the trip plan I purchase?</h3>
                        <p>All the published trip plans are listed on the seller’s profile page.</p>
                    </div>

                    <div id="q10" class="faq-answer-list">
                        <h3>Are there any fees to become a seller?</h3>
                        <p>No. Joining TripPlanShop and becoming a seller to list trip plans are free.</p>
                    </div>

                    <div id="q12" class="faq-answer-list">
                        <h3>I want to sell my trip plans. How can I become a seller?</h3>
                        <p>Click “Become a Seller”, then you will be requested to connect with Stripe, an online payment service provider. All transactions at TripPlanShop.com are processed by Stripe. Stripe has no setup fees, no monthly fees, or no card storage fees.</p>
                    </div>

                    <div id="q13" class="faq-answer-list">
                        <h3>What is my website and business names in Strip account?</h3>
                        <p>website is "www.tripplanshop.com" and name is "TripPlanShop".</p>
                    </div>

                    <div id="q14" class="faq-answer-list">
                        <h3 id="q14">Why should I make Stripe account to sell trip plans at TripPlanShop ?</h3>
                        <p>All transactions at TripPlanShop are processed by Stripe. Stripe provides trusted online payment service.</p>
                    </div>

                    <div id="q15" class="faq-answer-list">
                        <h3>What is a “trip plan”?</h3>
                        <p>Trip plans of TripPlanShop are expected to be detailed itineraries for any types of travels or events like special dates and parties that buyers can follow without much extra planning. Each trip plan contains overview, day overview and details. Contents of daily details vary on authors. Sharing unique travel styles, personal experiences or tips from the locals can be great asset.</p>
                    </div>

                    <div id="q16" class="faq-answer-list">
                        <h3>I can’t upload photos to photo gallery.</h3>
                        <p>The max image size is {{ strtoupper(env('MAX_FILE_UPLOAD_SIZE')) }} and image names can only contain numbers, letters, “_”, and “–“.</p>
                    </div>

                    <div id="q17" class="faq-answer-list">
                        <h3>How can I save my unfinished trip plans?</h3>
                        <p>Once each page is created, your unfinished itinerary is saved in “plans in progress-my trip plans” before publishing.</p>
                    </div>

                    <div id="q18" class="faq-answer-list">
                        <h3>Can I edit my published trip plans?</h3>
                        <p>Yes. You need to unpublish the trip plan to edit. While the unpublished trip plan is being edited, users who already purchased it can view previously published version.</p>
                    </div>

                    <div id="q19" class="faq-answer-list">
                        <h3>Can I delete trip plans I create?</h3>
                        <p>Yes. Trip plans can be deleted when it's unpublished. But if there is any sale of the trip plan within 6 months,
                            it cannot be deleted until the purchase expires. Users who already purchase trip plans still need to access them.</p>
                    </div>

                    <div id="q20" class="faq-answer-list">
                        <h3>How can I insert maps in my trip plans?</h3>
                        <p>You can copy and paste google map code into trip plan's source code.  <a href="{{ route('home.getSellerDetails') . "#create-trip-plans" }}">see more details</a></p>
                    </div>

                    <div id="q21" class="faq-answer-list">
                        <h3>How much does TripPlanShop charge on sales?</h3>
                        <p>For each sale, Stripe and TripPlanShop charge total 8% of the sale price and plus 60 cents.</p>
                    </div>
                    <div id="q22" class="faq-answer-list">
                        <h3>Facebook share image doesnt update</h3>
                        <p>Copy the full link of your trip plan and paste into <a target="_blank" href="https://developers.facebook.com/tools/debug/">here</a>. Click "Fetch new scrape information" to update your share image.</p>
                    </div>
                    <div id="q24" class="faq-answer-list">
                        <h3>How about taxes?</h3>
                        <p>All sales taxs are included at this time.</p>
                    </div>

                    <div id="q25" class="faq-answer-list">
                        <h3>How can I get paid for sales?</h3>
                        <p>You can add your bank account in Stripe to transfer money. Login to Stripe and set it up in your dashboard.</p>
                    </div>

                    <div id="q26" class="faq-answer-list">
                        <h3>Who should I contact for questions about payments and transactions?</h3>
                        <p>For any concerns regarding your payments and transactions, you need to contact Stripe.</p>
                    </div>

                    <div id="q27" class="faq-answer-list">
                        <h3>What is Stripe?</h3>
                        <p>Stripe has full control of online sales transaction at TripPlanShop.  Stripe is a trusted online payment service provider
                            to accept payments online and in mobile apps. Stripe has no setup fees, no monthly fees, or no card storage fees. Stripe
                            processes billions of dollars a year for thousands of businesses. Web and mobile businesses around the world using Stripe
                            include Twitter, Kickstarter, Shopify, Salesforce, Lyft, and many more. Go to Stripe website. (https://stripe.com/ca)</p>
                    </div>


                </div>
            </div>

        </div><!-- row -->

    </div><!-- .container -->
@stop