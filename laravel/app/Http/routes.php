<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use App\User;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => ['promo']], function(){
	Route::get('/', 'HomeController@index');
});

	//Route::get('/', 'PromoController@getPromoPage');
	Route::get('home', 'HomeController@index');
	Route::get('login', function(){
		return view('auth.login');
	});

	Route::get('Terms', ['as'=>'home.getTerms', 'uses'=>'HomeController@getTerms']);
	Route::get('contactus', ['as'=>'home.getContactus', 'uses'=>'HomeController@getContactus']);
	Route::post('contactus', ['as'=>'home.postContactus', 'uses'=>'HomeController@postContactus']);

	//Route::get('How-It-Works', ['as'=>'home.getHowitworks', 'uses'=>'HomeController@getHowitworks']);
	Route::get('Becoming-a-seller', ['as'=>'home.getBecomingSeller', 'uses'=>'HomeController@getBecomingSeller']);
	Route::get('Details-about-becoming-a-seller', ['as'=>'home.getSellerDetails', 'uses'=>'HomeController@getSellerDetails']);
	Route::get('FAQs', ['as'=>'home.getFaqs', 'uses'=>'HomeController@getFaqs']);



	Route::get('auth/facebook/callback', 'Auth\AuthController@getFacebookCallback');
	Route::controllers([
		//'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController'
	]);
	Route::get('auth/facebook', 'Auth\AuthController@getFacebook');
	Route::get('auth/login', ['as' => 'auth.getLogin', 'uses' => 'Auth\AuthController@getLogin']);




	//account activation link
	Route::get('account/activate/{token}', 'UsersController@activate');

	//resend activation code
	Route::get('account/resend-activation', ['as'=>'auth.getActivation', 'uses'=>'Auth\AuthController@getActivation']);
	Route::post('account/resent-activation', ['as'=>'auth.postResentActivation','uses'=>'Auth\AuthController@resendActivation']);



	//login required controllers
	Route::group(['middleware' => ['auth']], function()
	{
		//Stripe cx connect redirect_uri
		Route::get('user/stripe/sign-up', ['as'=>'user.stripeSignup', 'uses'=>'UsersController@stripeSignup']);
		Route::get('user/stripe/connect', ['as'=>'user.stripeConnect', 'uses'=>'UsersController@stripeConnect']);

		//comments
		Route::post('reviews/store', ['as'=>'review.store', 'uses'=>'ReviewController@store']);

		//itinerary m
		Route::resource('itinerary','ItineraryController', ['except'=>['show']]);
		//itinerary delete thru a GET url
		Route::get('itinerary-delete/{itinerary}', ['as'=>'itinerary.iti-delete', 'uses'=>'ItineraryController@destroy']);
		//itinerary favorite. this will throw an error to ajax requrest and ajax will redirect to "/login"
		Route::get('itinerary/favorite/{itinerary}', ['as'=>'itinerary.favorite', 'uses'=>'ItineraryController@favorite']);

		//itinerary publish
		Route::get('itinerary/publish/{itinerary}', ['as'=>'itinerary.publish', 'uses'=>'ItineraryController@publish']);
		Route::get('itinerary/unpublish/{itinerary}', ['as'=>'itinerary.unpublish', 'uses'=>'ItineraryController@unpublish']);
		//itinerary purchase confirmation
		Route::get('itinerary/confirm-purchase/{itinerary}', ['as'=>'itinerary.purchaseConfirm', 'uses'=>'ItineraryController@purchaseConfirm']);
		//itinerary purchase
		Route::post('itinerary/purchase/{itinerary}', ['as'=>'itinerary.purchase', 'uses'=>'ItineraryController@purchase']);
		//get itit free
		Route::get('itinerary/get-free-itinerary/{itinerary}', ['as'=>'itinerary.getItitFree', 'uses'=>'ItineraryController@getItitFree']);
		//itinerary sales details
		Route::get('itinerary/sales-statement/{itinerary}', ['as'=>'itinerary.getSalesDetails', 'uses'=>'ItineraryController@getSalesDetails']);

		//itineraryDay
		Route::resource('itinerary-day','ItiDayController');

		//users

		Route::resource('user','UsersController', ['except'=>['show']]);
		Route::get('user/my-tripplans/{user}', ['as'=>'user.getAllTripPlans','uses'=>'UsersController@getAllTripPlans']);
		Route::get('user/plans-in-progress/{user}', ['as'=>'user.getInProgress','uses'=>'UsersController@getProgressItinerary']);
		Route::get('user/wishlist/{user}', ['as'=>'user.liked','uses'=>'UsersController@getFavoriteList']);
		Route::get('user/purchased-plans/{user}', ['as'=>'user.purchasedList','uses'=>'UsersController@getPurchasedList']);

		Route::get('user/loginas/{name}', ['middleware' => 'admin', function($name)
		{
			$user = User::where('name', $name)->first();
			Auth::loginUsingId($user->id);
			return Redirect('/');
		}]);

	});



	//itinerary preview does not require login
	//later

	//itinerary search
	Route::get('itinerary-search', ['as'=>'itinerary.postSearch', 'uses'=>'ItineraryController@postSearch']);


	//itinerary preview, if user not logged in
	//Route::get('itinerary/preview/{itinerary}', ['as'=>'itinerary.preview', 'uses'=>'ItineraryController@preview']);

	Route::get('itinerary/{itinerary}', ['as'=>'itinerary.show', 'uses'=>'ItineraryController@show']);





	//if users click on Author to see profile without login
	Route::get('user/{user}', ['as'=>'user.show', 'uses'=>'UsersController@show']);
	//if users want to see what iti authors have in published bin but users not logged in yet
	Route::get('user/published/{user}', ['as'=>'user.getPublished','uses'=>'UsersController@getPublishedItinerary']);
	//Route::get('user/blog_redirect/{user}', ['as'=>'user.blog_redirect', 'uses'=>'UsersController@blog_redirect']);
	//show popular style
	//Route::get('itinerary/popular/{style}', ['as'=>'search.showPopularStyles', 'uses'=>'SearchController@showPopularStyles']);
	//itinerary show popular itineraries that has {{city}}
	//Route::get('itinerary/popular/{city_name}/{country}', ['as'=>'search.showPopularByCity', 'uses'=>'SearchController@showPopularByCity']);
	//get all pop itineraries
	Route::get('Popular-Itineraries', ['as'=>'itinerary.getPopTripPlansPage', 'uses'=>'ItineraryController@getPopTripPlansPage']);




//phpunit done
Route::get('promo', ['as' => 'promo.getPromoPage', 'uses' => 'PromoController@getPromoPage']);
Route::get('promo/screenshot', ['as' => 'promo.getItiExample', 'uses' => 'PromoController@getItiExample']);

//not done
Route::post('promo/notify-me-when-open', ['as' => 'promo.postNotifyMe', 'uses' => 'PromoController@postNotifyMe']);
Route::post('promo/contact-us', ['as' => 'promo.postContactUs', 'uses' => 'PromoController@postContactUs']);




Route::get('auth/facebook/callback', 'Auth\AuthController@getFacebookCallback');
Route::get('auth/facebook', 'Auth\AuthController@getFacebook');
Route::get('auth/register', ['as' => 'Auth\AuthController@getRegister', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'Auth\AuthController@postRegister', 'uses' => 'Auth\AuthController@postRegister']);
Route::post('auth/login', ['as' => 'Auth\AuthController@postLogin', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'Auth\AuthController@getLogout', 'uses' => 'Auth\AuthController@getLogout']);


//account activation link
Route::get('account/activate/{token}', 'UsersController@activate');

//example itinerary
Route::get('promo/itinerary-example', ['uses' => 'ItineraryController@getItineraryExample']);
