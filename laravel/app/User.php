<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Laravel\Cashier\Billable;
use Laravel\Cashier\Contracts\Billable as BillableContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {



	use Authenticatable, CanResetPassword, Billable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'active','activation_token'];
	protected $dates = ['trial_ends_at', 'subscription_ends_at'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function profile()
	{
		return $this->hasOne('App\Profile');
	}

	public function transactions()
	{
		return $this->belongsToMany('App\Itinerary', 'transactions')
						->withPivot('purchase_price', 'currency', 'is_read')
						->withTimestamps();
	}

	public function likedItineraries()
	{

	}

	public function itineraries()
	{
		return $this->hasMany('App\Itinerary');
	}

	public function reviews()
	{
		return $this->hasMany('App\Review');
	}

	/**
	 * Get the value of the model's route key.
	 *
	 * @return mixed
	 */
	public function getRouteKey()
	{
		$hashids = new \Hashids\Hashids(env('MY_SECRET_SALT'), 12);

		return $hashids->encode($this->getKey());
	}


	public function scopeActivation($query, $token)
	{

		return $query->where('activation_token','=',$token);

	}
}
