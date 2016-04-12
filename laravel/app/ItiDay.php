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

    public function getlocations()
    {
        return $this->belongsToMany('App\Location')->withTimestamps();
    }

    public function getRouteKey()
    {
        $hashids = new \Hashids\Hashids(env('MY_SECRET_SALT'), 12);

        return $hashids->encode($this->getKey());
    }

    public function getExperienceAttribute()
    {
        return  explode(',', $this->attributes['top_exp']);
    }

    public function getTopExpNames()
    {
        $exp_array = explode(',', $this->attributes['top_exp']);
        $TopExpNames = Experience::find($exp_array);
        return $TopExpNames;
    }

}
