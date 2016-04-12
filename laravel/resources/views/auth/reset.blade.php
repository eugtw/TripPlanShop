@extends('app')

@section('content')
	<div class="row screen-height">
	<form method="POST" action="/password/reset" class="form-signin">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<h2 class="form-signin-heading">Password Reset</h2>
		<input type="hidden" name="token" value="{{ $token }}">

		<label for="email" class="sr-only">Email</label>
		<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address" required autofocus>


		<label for="password" class="sr-only">Password</label>
		<input type="password" name="password" class="form-control" placeholder="Password">

		<label for="password_confirmation" class="sr-only">Confirm Password</label>
		<input type="password" name="password_confirmation" class="form-control" placeholder="password_confirmation">

		<button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
	</form>
	</div>






@endsection
