<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use Illuminate\Contracts\Auth\PasswordBroker;
use GuzzleHttp;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller {
	/*
        |--------------------------------------------------------------------------
        | Registration & Login Controller
        |--------------------------------------------------------------------------
        |
        | This controller handles the registration of new users, as well as the
        | authentication of existing users. By default, this controller uses
        | a simple trait to add these behaviors. Why don't you explore it?
        |
        */

	use AuthenticatesAndRegistersUsers;

	protected $redirectPath_Home = '/home';

	/**
	 * Redirect the user to the Facebook authentication page.
	 *
	 * @return Response
	 */
	public function getFacebook()
	{
		return Socialite::driver('facebook')->redirect();
	}

	/**
	 * Obtain the user information from Facebook.
	 *
	 * @return Response
	 */
	public function getFacebookCallback()
	{
		try {
			$user = Socialite::driver('facebook')->user();
		} catch (Exception $e) {
			return "Error!!! Please try register or login manually.";
		}

		$authUser = $this->findOrCreateUser($user);

		Auth::login($authUser, true);

		return redirect($this->redirectPath_Home)->withMessage('You are now signed in through Facebook');
	}

	/**
	 * Return user if exists; create and return if doesn't
	 *
	 * @param $facebookUser
	 * @return User
	 */
	private function findOrCreateUser($facebookUser)
	{
		$authUser = User::where('email', $facebookUser->email)->first();

		if ($authUser){
			return $authUser;
		}

		$user = User::create([
			'name' => $facebookUser->name,
			'email' => $facebookUser->email,
			'active' => 1
			//'facebook_id' => $facebookUser->id,
			//'avatar' => $facebookUser->avatar
		]);


		//create user profile, also in UserController
		$profile = Profile::firstOrCreate([
			'user_id' => $user->id
			//'avatar' => $facebookUser->avatar
		]);

		$profile->avatar = $facebookUser->avatar;
		$profile->save();

		return $user;
	}


	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:100|unique:users|username',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:8',
		]);

	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data)
	{
		$user =  User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);

		//create new user's profile
		Profile::create([
			'user_id'=>$user->id
		]);

		return $user;
	}

	public function postLogin(Request $request)
	{
		$email = $request->email;
		$password = $request->password;
		$remember = ($request->has('remember')) ? true : false;
		if(Auth::viaRemember())
		{
			//Auth passes, check on "active" status
			if(Auth::user()->active){
				return redirect()->intended($this->redirectPath_Home)->withMessage('welcome back');
			}
		}
		if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {

			//Auth passes, check on "active" status
			if(Auth::user()->active){

				//track last login time in "updated_at" column
				Auth::user()->touch();
				return redirect()->intended($this->redirectPath_Home)->withCookie(cookie()->forever('last_user',Auth::user()->email));
			}

			//if logged in users' status is not "active", logout now
			Auth::logout();
			return back()->withInput()->withErrors("account not activated or locked");
		}
		//Auth failed
		return back()->withInput()->withErrors('Incorrect email or password');

	}

	public function getRegister()
	{
		return view('auth.register');
	}
	public function postRegister(Request $request)
	{
		$validator = $this->validator($request->all());

		//if validation fails
		if($validator->fails())
		{
			return back()->withInput()->withErrors($validator);
		}

		$token =str_random(10);
		$user = User::create([
			'name' => ucwords($request->name),
			'email' => $request->email,
			'activation_token' => $token,
			'password' => bcrypt($request->password)
		]);

		//send activation email
		$url = secure_url('account/activate/'.$token);

		Mail::send('emails.activation', ['url'=> $url, 'user'=>$user], function($m) use($url,$user){
			$m->to($user->email, $user->name)->subject('Account Activation');
		} );

		//profile will be created when confirm email clicked (userscongroller@activate)

		return view('auth.welcome')->withEmail($request->input('email'));
	}

	public function getActivation()
	{
		return view('auth.getActivation');
	}
	public function resendActivation(Request $request)
	{
		$user = User::where('email','=',$request->email)->first();

		if(!$user){
			//if user found
			return redirect()->back()->withErrors('Email not found! Please try again');
		}
		elseif($user->active == 1){//if user already activated
			return redirect('/login')->withErrors('Your Account is already activated!');
		}

		//generate new token
		$token =str_random(10);
		$user->activation_token = $token;
		$user->save();

		$url = action('UsersController@activate', $user->activation_token);

		$response = Mail::send('emails.activation', ['url'=>$url,'user'=>$user], function($m) use($url, $user){
			$m->to($user->email, $user->name)->subject('Account Activation');
		});

		return redirect('/login')->withMessage('Actication code sent to the email entered');

	}

}
