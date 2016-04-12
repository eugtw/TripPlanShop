@extends('app', ['title' => 'TripPlanShop - Sign Up'])

@section('content')
	<div class="row screen-height">
	<form method="POST" action="{{ url('/auth/register') }}" class="form-signin">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<h2 class="form-signin-heading">Sign up</h2>
		<label for="name" class="sr-only">User Name</label>
		<input type="name" name="name" class="form-control" placeholder="User Name" value="{{old('name')}}" required autofocus>

		<label for="email" class="sr-only">Email address</label>
		<input type="email" name="email" class="form-control" placeholder="Email address" value="{{old('email')}}" required>

		<label for="password" class="sr-only">Password</label>
		<input type="password" name="password" class="form-control" placeholder="Password" required>

		<label for="password_confirmation" class="sr-only">Confirm Password</label>
		<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>

		<button class="btn btn-primary btn-block" type="submit">Sign up</button>
		<div>
			<a class="btn btn-facebook btn-block" href="{{ url('/auth/facebook') }}" role="button"><i class="fa fa-lg fa-facebook pull-left"></i>Sign up with Facebook</a>
		</div>
	</form>
	</div>

@endsection
