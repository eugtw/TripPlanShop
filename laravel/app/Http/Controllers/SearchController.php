<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Itinerary;
use App\TravelStyle;
use App\Http\Controllers\Controller;
use App\Country;
use Illuminate\Http\Request;

class SearchController extends Controller {
/*
	public function showPopularByCity($city, $country_id)
	{
		//to populate dropdown search box
		$styles = TravelStyle::all()->lists('style','style');
		$countries = Country::all()->lists('country','country');

		$itineraries = Itinerary::whereHas('cities', function($q) use ($city){
			$q->where('city','=',$city );
		})->get();
		/*$itineraries = Itinerary::whereHas('cities',function($q)
		{
			//$q->where('id', '=',7);
		})->get();*/


		//more recent trip plans
	/*	$recentItineraries = Itinerary::whereNotIn('id', $itineraries->lists('id'))
								->published(true)->orderBy('created_at')->paginate(env('RECENT_ITI'));

		return view('itinerary.searchResults')
			->with('recentItineraries', $recentItineraries)
			->withCountries($countries)
			->with('selected_location', $city)
			->withItineraries($itineraries)
			->withStyles($styles);
	}

	public function showPopularStyles($style)
	{
		//to populate dropdown search box
		$styles = TravelStyle::all()->lists('style','style');
		$countries = Country::all()->lists('country','country');

		$itineraries = Itinerary::
		where('published','=',env('ITI_PUBLISHED'))
		->whereHas('styles', function($q) use ($style)
		{
			$q->where('style','=',$style);
		})->get();

		//more recent trip plans
		$recentItineraries = Itinerary::whereNotIn('id', $itineraries->lists('id'))
								->published(true)->orderby('created_at')->paginate(env('RECENT_ITI'));

		return view('itinerary.searchResults')
			->with('recentItineraries', $recentItineraries)
			->with('selected_style', $style)
			->withCountries($countries)
			->withItineraries($itineraries)
			->withStyles($styles);
	}
*/
}
