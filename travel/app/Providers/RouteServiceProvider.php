<?php namespace App\Providers;

use App\ItiDay;
use App\ItiDayPlace;
use App\Itinerary;
use App\User;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);


		//route model binding: itinerary
		//$router->model('itinerary', 'App\Itinerary');
		$router->bind('itinerary', function($value)
		{
			return Itinerary::whereSlug($value)->firstOrFail();

		});

		//route model binding: user
		$router->bind('user', function($value, $route)
		{
			$hashids = new \Hashids\Hashids(env('MY_SECRET_SALT'), 12);

			$id = $hashids->decode($value)[0];

			return User::findOrFail($id);

		});

		//route model binding: itiday
		$router->bind('itinerary-day', function($value, $route)
		{
			$hashids = new \Hashids\Hashids(env('MY_SECRET_SALT'), 12);

			$id = $hashids->decode($value)[0];

			return ItiDay::findOrFail($id);

		});

		$router->model('day-place', 'App\ItiDayPlace');
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
