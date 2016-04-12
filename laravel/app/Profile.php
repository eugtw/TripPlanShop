<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

    protected $table = 'profiles';

    protected $fillable = ['travel_style','about_yourself', 'avatar','user_id', 'blog_link'];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

}
