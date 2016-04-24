<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Conner\Likeable\LikeableTrait;



class Itinerary extends Model
{

    use LikeableTrait;

    //protected $fillable = ['user_id','days_stay','title','summary','best_season'];
    protected $guarded = ['id', 'created_at'];




    public function transactions()
    {
        /*$v = $this->belongsToMany('App\User', 'transactions')
            ->withPivot('purchase_price', 'currency', 'is_read')
            ->withTimestamps()->toSql();
        return dd($v);*/
        return $this->belongsToMany('App\User', 'transactions')
            ->withPivot('id','purchase_price', 'currency', 'is_read')
            ->withTimestamps();
    }

    public function unreadSales()
    {

        return DB::table('transactions')
                ->select('transactions.*')
                ->where('itinerary_id', $this->id)
                ->where('is_read', 0)
                ->get();

        /*return $this->belongsToMany('App\User', 'transactions')
            ->withPivot('purchase_price', 'currency', 'is_read')
            ->whereHas('transactions',function($q)
            {
                $q->where('is_read', 0);
            })->get();*/
    }
    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function styles()
    {
        return $this->belongsToMany('App\TravelStyle', 'itinerary_style', 'itinerary_id','style_id')->withTimestamps();
    }

    public function cities()
    {
        return $this->belongsToMany('App\City', 'city_itinerary')->withTimestamps();
    }

    public function days($is_preview = 0)
    {
        if($is_preview)
        {
            return $this->hasMany('App\ItiDay')
                        ->where('day_num', '=','1');
        }else{
            return $this->hasMany('App\ItiDay');
        }

    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    /**retrieve col"items_list" from itinerary and return it as array for checkboxes
     * @return array
     */
    public  function getItemsArray()
    {
        return  explode(',', $this->attributes['items_list']);
    }
    /**
     * Get a list of style tag ids with the current itinerary
     * @return array
     */
    public function getStylesListAttribute()
    {
        return $this->styles->lists('id');
    }

    /**
     * Get a list of city tag ids with the current itinerary
     * @return mixed
     */
    public function getCitiesListAttribute()
    {
        return $this->cities->lists('id');
    }


    /**
     * @return full name "city, state, country"
     */
    public function getCitiesListFullAttribute()
    {
        $list = DB::table('cities')
            ->join('countries', 'country_id', '=','countries.id')
            ->join('city_itinerary', 'cities.id','=','city_itinerary.city_id')
            ->select(DB::raw("CONCAT(city , ',', state, ',',country) AS full_name, cities.id"))
            ->where('city_itinerary.itinerary_id','=',$this->id)
            ->lists('full_name', 'full_name');

        return $list;
    }
    /**
     * Get random models
     */
    public function scopeRandom($query)
    {
        return $query->orderBy(DB::raw('RAND()'));
    }

    public function scopePublished($query, $flag)
    {
        return $query->where('published','=',$flag);
    }

    /**
     * Get popular cities
     */
    public function scopePopular($query)
    {
        return $query->has('reviews', '>=', '0');
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
}
