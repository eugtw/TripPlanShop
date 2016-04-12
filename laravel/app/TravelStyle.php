<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TravelStyle extends Model {

    protected $table = 'travelstyles';
    protected $fillable = ['style'];

    public function itineraries()
    {
        return $this->belongsToMany('App\Itinerary', 'itinerary_style', 'itinerary_id','style_id');
    }

    /**
     * Get random models
     */
    public function scopeRandom($query)
    {
        return $query->orderBy(DB::raw('RAND()'));
    }
}
