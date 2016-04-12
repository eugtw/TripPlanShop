<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Redirector;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;
	protected $user;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth, $user
	 * @return void
	 */
	public function __construct(Guard $auth, Guard $user)
	{
		$this->auth = $auth;
		$this->user = $user;
	}
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('auth/login');
			}
		}

		if ($this->auth->user()->active == 0)
		{
			$this->auth->logout();
			return redirect()->route('auth.getActivation')
				->withErrors('Account Not Activated yet. Please Activate');
		}

		return $next($request);
	}

}
