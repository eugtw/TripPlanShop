@extends('promo.promo-app')


@section('meta-og')
    <meta property="og:url"                content="{{ route('promo.getPromoPage') }}">
    <meta property="og:type"               content="article">
    <meta property="og:title"              content="{{ 'TripPlanShop.com is coming soon | Sign Up Today' }}">
    <meta property="og:description"        content="{{ 'Find personalized trip plans that fit your travel styles' }}">
    <meta property="og:image"              content="http://tripplanshop.com/images/site/promo-mar-16.png">
    <meta property="og:site_name"           content=""/>
    <meta property="fb:app_id"             content="{{ env('FB_CLIENT_ID') }}"
@stop


@section('content')


        <div class="col-sm-6 col-xs-12 sameHeight" id="content-box-left">
            <h1><span class="strong-highlight">TripPlanShop.com</span> is coming soon</h1>
            <h2>Buy and sell trip plans that fit your travel styles</h2>
            <h3>Join us and experience the destination like an insider</h3>
            <p>Interested in becoming a seller? <a href="{{route('promo.getContactUs')}}">contact us</a></p>
            <p>Already a seller? <a href="{{ route('promo.getLogin') }}">Log in</a></p>

            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div id="addthis-toolbox">
                <div class="addthis_sharing_toolbox inline-block"></div>
            </div>


            <div class="clearfix"></div>
        </div>
        <div class="col-sm-6 col-xs-12 sameHeight" id="content-box-right">
                <p>Get notified when open</p>
                {!! Form::open(['route' => 'promo.postPromoPage', 'class' => 'form']) !!}

                <div class="form-group">
                    {!!  Form::label('email', 'Email') !!}
                    {!!  Form::email('email', null, ['required', 'class'=>'form-control', 'placeholder' => 'Email Address']) !!}
                </div>
                <div class="form-group">
                    {!!  Form::submit('Send', ['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}

                <!-- messages -->
                @if($errors->any())
                        <div class="text-center alert alert-danger col-xs-12">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                @endif
                @if (session('status'))
                        <div class="text-center alert alert-success col-xs-12">
                            {{ session('status') }}
                        </div>

                @endif
                @if(Session::has('message'))
                        <div class="text-center alert alert-success col-xs-12">
                            {{ Session::get('message') }}
                        </div>
                @endif
        </div>
    @stop