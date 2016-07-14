<?php namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Itinerary;
use Illuminate\Database\Eloquent;
use App\TravelStyle;
use App\City;

class HomeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$itineraries = Itinerary::with('cities')->with('styles')->with('reviews')->with('days')->get();

		$pop_cities = 		City::where('popular','=','1')->take(3)->orderBy('id')->get();

		//lazy eager load itineraries
		$pop_itineraries = 	Itinerary::with('cities')->with('styles')->with('reviews')->with('days')
										->where('published','=', env('ITI_PUBLISHED'))
										->popular()->random()->take(3)->get();
		$pop_styles = 		TravelStyle::where('popular','=','1')->orderBy('id')->get();
									//->has('itineraries')->random()->take(5)->get();

		//return dd($pop_itineraries);
		return view('home')
			->with('pop_cities', $pop_cities)
			->with('pop_itineraries', $pop_itineraries)
			->with('pop_styles', $pop_styles);
	}

	public function getContactus()
	{
		return view('contactus');
	}

	public function postContactus(Request $request)
	{
		$name = $request->name;
		$email = $request->email;
		$content = $request->message;
		$title = $request->title;

		$image_path = public_path().'/images/site/logo.jpg';

		Mail::send('emails.contactus', ['name'=>$name,'email'=>$email,'content'=>$content, 'image_path' => $image_path],function($message) use($image_path, $name,$email,$content, $title)
		{
			$message->from($email)
						->to(env('MAIL_ADMIN'))
						->subject($title);
		});

		return view('postContactus');
	}

	/*public function getHowitworks(){

		return view('howitworks');
	}*/

	public function getBecomingSeller()
	{
		if(!$itiEx = Itinerary::find(env('DEMO_ITIT_ID')))
		{
			$itiEx = Itinerary::where('published', 1)->take(1)->get();
		}

		return view('becoming-seller')->with('itineraries', $itiEx);
	}

	public function getSellerDetails()
	{
		return view('seller-details');
	}

	public function getTerms()
	{
		return view('terms');
	}

	public function getFaqs()
	{
		return view('faqs');
	}
}
