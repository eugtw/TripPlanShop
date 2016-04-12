@extends('app', ['title' => 'TripPlanShop - Sign In'])

@section('content')
	<div class="row">
	<form method="POST" action="{{ url('/auth/login') }}" class="form-signin">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<h2 class="form-signin-heading">Login</h2>
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
		<p>
			<a href="{{ url('/auth/register') }}">Sign up</a>
			<span> | </span>
			<a href="{{ url('/password/email') }}">Password</a>
			<span> | </span>
			<a href="{{ route('auth.getActivation') }}">Account activation</a>
		</p>

		<div>
			<a class="btn btn-facebook btn-block" href="{{ url('/auth/facebook') }}" role="button"><i class="fa fa-lg fa-facebook pull-left"></i>Sign In with Facebook</a>
		</div>
	</form>
	</div>
@endsection
