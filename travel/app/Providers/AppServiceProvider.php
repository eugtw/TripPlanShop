<?php namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use app\Services\ValidatorExt;
use App\Services\CustomValidation;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
		$this->app['validator']->resolver(function($translator, $data, $rules, $messages)
		{
			$messages = [
				'foldername'=>'Incorrect gallery folder selected',
				'imagename'=>'Cover Image selected is invalid',
				'username'=>'Invalid username'
			];
			return new CustomValidation($translator, $data, $rules, $messages);
		});


	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);



	}

}
