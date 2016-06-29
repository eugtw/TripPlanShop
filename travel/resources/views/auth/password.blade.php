@extends('app')

@section('content')

	<div class="row screen-height">
	<form method="POST" action="{{ url('/password/email') }}" class="form-signin">
		<h2 class="form-signin-heading">Password Reset</h2>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<label for="email" class="sr-only">Email</label>
		<input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email address" required autofocus>
		<button class="btn btn-primary btn-block" type="submit">Send</button>
	</form>
	</div>


@endsection
