<?php namespace App\Http\Controllers;

use App\TravelStyle;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	public function __construct()
	{
		$travelStyles = TravelStyle::all()->sortBy('style')->lists('style','style');
		$travelCountries = \App\Country::all()->lists('country','country');
		$travelCities = \App\City::all()->lists('city','city');

		view()->share('travelStyles', $travelStyles);
		view()->share('travelCountries', $travelCountries);
		view()->share('travelCities', $travelCities);
	}

}
