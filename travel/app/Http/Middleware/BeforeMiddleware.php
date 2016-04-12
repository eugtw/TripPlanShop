<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Support\Facades\Auth;

class BeforeMiddleware implements Middleware{

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(Auth::user()->name == env('ADMIN_NAME'))
		{
			return $next($request);
		}else{

			return redirect('/');
		}



	}

}
