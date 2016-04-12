<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class City extends Model {

    protected $table = 'cities';
    protected $fillable = ['city', 'state','country_id', 'image'];

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function itineraries()
    {
        return $this->belongsToMany('App\Itinerary', 'city_itinerary');
    }

    public function location()
    {
        return $this->hasOne('App\location');
    }

    /**
     * Get random models
     */
    public function scopeRandom($query)
    {
        return $query->orderBy(DB::raw('RAND()'));
    }

    /**
     * Get popular cities
     */
    public function scopePopular($query)
    {
        return $query->has('itineraries');
    }
}
