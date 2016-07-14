<?php namespace App\Http\Controllers;

use App\Profile;
use App\UserProfile;
use Image;
use Crypt;
use Storage;
use Auth;

use App\Itinerary;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UsersController extends Controller {

	public function stripeSignup()
	{
		return view('users.StripeConnect');
	}

	/**
	 * Stripe redirect_uri after connected
	 *
	 * @return \Illuminate\View\View
	 */
	public function stripeConnect(Request $request)
	{
		//do something
		if($request->has('error')){
			return back()->withErrors($request->error_description);
		}


		if ($request->has('code')) { // Redirect w/ code
			$code = $request->code;

			$token_request_body = array(
				'grant_type' => 'authorization_code',
				'client_id' => env('STRIPE_CLIENT_ID'),
				'code' => $code,
				'client_secret' => env('PLATFORM_SECRET_KEY')
			);

			$req = curl_init('https://connect.stripe.com/oauth/token');
			curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($req, CURLOPT_POST, true );
			curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($token_request_body));

			// TODO: Additional error handling
			$respCode = curl_getinfo($req, CURLINFO_HTTP_CODE);
			$resp = json_decode(curl_exec($req), true);
			curl_close($req);

			if(isset($resp['error']))
			{
				return var_dump($resp) . $resp['error_description'];
			}

			//store data
			$user = Auth::user();
			$user->stripe_active 			= 1;
			$user->stripe_id 				= $resp['stripe_user_id'];
			$user->refresh_token 			= $resp['refresh_token'];
			$user->access_token 			= $resp['access_token'];
			$user->stripe_publishable_key 	= $resp['stripe_publishable_key'];
			$user->save();
			//echo $resp['access_token'];

		}

		// Stripe set up success so create user img folder in root
		if (!file_exists('./files' .'/' . strtolower(Auth::user()->name))) {

			mkdir('./files' .'/' . strtolower(Auth::user()->name), 0777, true);

		}
		return view('users.postStripeConnect');
	}


	public function show(User $user)
	{
		$p_itis = Itinerary::where(['published'=>1, 'user_id'=> $user->id])->orderby('updated_at', 'desc')->paginate(6);

		return view('users.admin-page')
			->with('published_iti', $p_itis)
			->withUser($user);
	}

	public function edit(User $user)
	{
		return view('users.edit-user-profile')->withUser($user);
	}

	public function update(Request $request, User $user)
	{

		//find or instantiate profile
		$userProfile = Profile::firstOrNew(['user_id' => $user->id]);

		//validation
		$this->validate($request,[
			'contact_email' => 'sometimes|required|email',
			'avatar' => 'max:5000|mimes:jpeg,png',
			'about_yourself' => 'required',
			'travel_style' => 'required'
		]);


		//if(Request::hasFile('avatar'))
		if($request->hasFile('avatar'))
		{
			$userImgPath = '.'.$userProfile->avatar;

			if(\File::isFile($userImgPath))
			{
				\File::delete($userImgPath);
			}



			//get uploaded image
			$file = $request->file('avatar');
			$image_name = time() . '-' . Auth::user()->name . '.' . $file->getClientOriginalExtension();

			//create and save image
			//public Intervention\Image\Image save([string $path, [int $quality]])

			$img = Image::make($file)->resize(300, 300)->save(".".env('USER_AVATAR_PATH') . $image_name);
			$userProfile->avatar = env('USER_AVATAR_PATH') . $image_name;

		}

		//saving UserProfile record
		$userProfile->about_yourself = $request->about_yourself;
		$userProfile->travel_style = $request->travel_style;
		$userProfile->contact_email = $request->contact_email;
		$userProfile->blog_link = $request->blog_link;
		$userProfile->user()->associate($user);
		//  Finally save the updated record to the database and return to the users view.

		$userProfile->save();

		return redirect()->route('user.show',[$user]);
	}

	public function getAllTripPlans(User $user)
	{
		return view('users.my-trip-plans')->withUser($user);
	}

	public function getPurchasedList(User $user)
	{
		$itineraries = $user->transactions()->orderby('created_at', 'desc')->get();

		return view('users.user-tripplans')
			->withTitle("Purchased Plans")
			->with('is_preview', 0)
			->withItineraries($itineraries);
	}


	public function getFavoriteList(User $user)
	{
		$itineraries = Itinerary::whereLiked($user->id)
			->orderby('created_at', 'desc')->get();//->paginate(env('ITI_PAGI_NUM_FAV'));

		return view('users.user-tripplans')
			->withTitle("Wish List")
			->with('is_preview', 1)
			->withItineraries($itineraries);
	}

	/**
	 * displays users' admin page
	 * @param $id
	 * @return \Illuminate\View\View
	 */
	public function getPublishedItinerary(User $user)
	{
		$itineraries = Itinerary::where(['user_id' => $user->id, 'published'=>env('ITI_PUBLISHED')])
			->orderby('updated_at', 'desc')->paginate(env('ITI_PAGI_NUM_PUBLISHED'));

		return view('users.iti_published_overview')->withItineraries($itineraries);

		/*return view('users.user-tripplans')
			->withTitle("Published Plans")
			->withPurchased('1')
			->withItineraries($itineraries);*/
	}

	public function getProgressItinerary(User $user)
	{
		$itineraries = Itinerary::where(['user_id' => $user->id, 'published'=>env('ITI_NOT_PUBLISHED')])
			->orderby('updated_at', 'desc')->get();//->paginate(env('ITI_PAGI_NUM_PUBLISHED'));

		return view('users.user-tripplans')
			->withTitle("Plans in Progress")
			->with('is_preview', 0)
			->with('plan_in_progress_page', 1)
			->withItineraries($itineraries);
	}


	public function blogredirect(User $user)
	{
		return redirect()->away($user->blog_link);
	}

	/**
	 * activate account when user click activation link from emails
	 *
	 * @param $id
	 */
	public function activate($token)
	{

		$user = User::activation($token)->get()->first();

		if ($user)
		{
			$user->active = 1;
			$user->save();

			//create user profile, also in AuthController
			Profile::firstOrCreate([
				'user_id' => $user->id
			]);

			return redirect('/login')->withMessage("Account activated. Please login to continue.");

		}

		return "Failed to activate account!! Please use the latest sent activation link.";

	}


}
