@extends('views.promo.promo-app')
@section('content')
    <header class="" id="pm-header">
        <a href="/promo"><img id="pm-logo" src="{{ env('SITE_IMAGE_PATH') . 'promo-logo.jpg' }}" alt="logo"></a>
        <div id="pm-header-login-box">
            <div class="col-sm-6 col-sm-offset-3 col-xs-12" id="content-box-right">
                <form method="POST" action="{{ url('/auth/login') }}" class="form-signin">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <h2 class="login">Login</h2>
                    <label for="email" class="sr-only">Email address</label>
                    <input type="email" name="email" class="form-control" value="{{Request::cookie('last_user')}}" placeholder="Email address" required autofocus>
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="1" checked> Remember me
                        </label>
                    </div>
                    <button class="btn btn-block" type="submit">Sign in</button>

                </form>
                <div class="clearfix"></div>
            </div>

        </div>
    </header>


@stop