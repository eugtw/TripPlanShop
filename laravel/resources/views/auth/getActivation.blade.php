@extends('app')

@section('content')
    <div class="row screen-height">
    <form method="POST" action="{{ route('auth.postResentActivation') }}" class="form-signin">

        <h2 class="form-signin-heading">Account Activation</h2>

        <label for="email" class="sr-only">Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Email address" value="{{old('email')}}" required>

        <button class="btn btn-primary btn-block" type="submit">Send</button>
    </form>
    </div>
@stop
