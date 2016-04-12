@extends('views.promo.promo-app')
@section('meta-og')
    <meta property="og:url"                content="{{ url('promo/contact-us') }}">
    <meta property="og:type"               content="article">
    <meta property="og:title"              content="{{ 'Become a Trip Plan Seller | Join for Free' }}">
    <meta property="og:description"        content="{{ 'We are looking for experienced travellers to create trip plans.' }}">
    <meta property="og:image"              content="http://tripplanshop.com/images/site/promo-mar-16.png">
    <meta property="og:site_name"           content=""/>
    <meta property="fb:app_id"             content="{{ env('FB_CLIENT_ID') }}"
@stop
@section('content')

    <div class="col-sm-6 col-xs-12 sameHeight" id="contactus-content-box-left">

        <h1>Become a trip plan seller at <a class="strong-highlight" href="{{ url('promo') }}">TripPlanShop.com</a> and we are opening soon</h1>
        <h2>Earn money selling your trip plans. Profit from combining your travel blog or tour business with our website.</h2>
        <h4>Contact us and join for free.</h4>
        <p>&lt&lt See <a class="reg-link" href=""  data-toggle="modal" data-target="#myModal">How It Works</a> &gt&gt</p>
        <p>&lt&lt back to <a class="strong-highlight" href="{{ url('promo') }}"><b>TripPlanShop</b></a> &gt&gt</p>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <div id="addthis-toolbox">
            <div class="addthis_sharing_toolbox inline-block"></div>
        </div>
    </div>
    <div class="col-sm-6 col-xs-12 sameHeight" id="content-box-right">
            <form method="POST" action="{{ route('promo.postContactUs') }}" class="form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    {!! Form::label('Your Name','', ['class' => ' sr-only']) !!}
                    {!! Form::text('name', null,
                    array('required',
                    'class'=>'form-control',
                    'placeholder'=>'Your Name')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Your E-mail Address','', ['class' => ' sr-only']) !!}
                    {!! Form::email('email', null,
                    array('required',
                    'class'=>'form-control',
                    'placeholder'=>'Email Address')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Something about you') !!}
                    {!! Form::textarea('message', null,
                    array('required',
                    'class'=>'form-control',
                    'placeholder'=>'Tell us something about you, your blog, your background')) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Invite me',
                    array('class'=>'btn itit-footer-button btn-primary')) !!}
                </div>
            </form>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">How It Works</h4>
                </div>
                <div class="modal-body">
                    <ol>
                        <li>Create trip plans with travel style tags, and list them for free or a price.
                            <p>e.g. “4 Days in Romantic Paris",  ( #couple & romantic #easy pace )</p></li>
                        <li>If you have websites or tour services that you want to promote, include the links in your trip plans.</li>
                        <li>Share the trip plans on social web pages.</li>
                        <li>Get paid for each sale of trip plans.</li>
                    </ol>

                    <p>   *** You will get charged total 8% + 60cents (US) for each trip plan sale. (All payment charges are included.) / No commission charge on any sales of tours and bookings.</p>
                 </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

@stop