@extends('app')

@section('content')

    <div class="container">
        <div class="col-sm-6 col-sm-offset-3 col-xs-12 top-buffer2 screen-height">
            <p>Almost done!</p>
            <p>Please activate your account through the activation link sent to: <b>{!! $email !!}</b></p>
            <p><a href="/auth/login">Back to Login</a></p>
        </div>
    </div>


    @stop