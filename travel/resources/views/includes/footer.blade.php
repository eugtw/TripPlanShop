<div class="footer">
    <div id="footer-content" class="col-sm-8 col-sm-offset-2 col-xs-12">
        <p class="text-center">About Us</p>
        <p class="text-center col-xs-12 col-sm-8 col-sm-offset-2">TripPlanShop is a marketplace for travel lovers to buy and sell trip plans. Travellers can find trip
            plans for their styles and benefit from other travellers' experiences.
        </p>
        <div class=" text-center">
            <ul class="list-unstyled list-inline">
                @if(Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    <li><a href="{{ url('/auth/register') }}">Join</a></li>
                @else
                    <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                @endif
                <li><a href="{{ route('home.getContactus') }}">Contact</a></li>
                <li><a href="{{ route('home.getTerms') }}">Terms & Privacy</a></li>
            </ul>
        </div>
    </div>

    <div class="clearfix"></div>

    <div id="trademark">
        <p class="text-center">&copyTripPlanShop 2016</p>
    </div>
</div>