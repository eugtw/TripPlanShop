<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class ItiDay extends Model {

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['itinerary'];

    protected $guarded = [
        'id'
    ];

    protected $table = 'itidays';

    public function itinerary()
    {
        return $this->belongsTo('App\Itinerary');
    }


    public function getRouteKey()
    {
        $hashids = new \Hashids\Hashids(env('MY_SECRET_SALT'), 12);

        return $hashids->encode($this->getKey());
    }


    public function places()
    {
        return $this->hasMany('\App\ItiDayPlace', 'itiday_id');
    }

    public function photos()
    {
        return $this->hasMany('App\ItiDayPhoto', 'itiday_id');
    }

    public function addPhoto(ItiDayPhoto $photo)
    {

        return $this->photos()->create([
            'name' => $photo->name,
            'photo_path' => $photo->photo_path
        ]);
    }

}
