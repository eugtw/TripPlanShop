<?php namespace App\Http\Controllers;

use App\TravelStyle;
use App\Experience;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	public function __construct()
	{
		$exp = Experience::all()->sortBy('experience')->lists('experience','id');

		$travelStyles = TravelStyle::all()->sortBy('style')->lists('style','style');
		$travelCountries = \App\Country::all()->lists('country','country');
		$travelCities = \App\City::all()->lists('city','city');

		view()->share('experiences', $exp);

		view()->share('travelStyles', $travelStyles);
		view()->share('travelCountries', $travelCountries);
		view()->share('travelCities', $travelCities);

	}

}
