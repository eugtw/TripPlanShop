<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

    protected $guarded = ['id','created_at'];

    public function getTimeagoAttribute()
    {
        //$date = CarbonCarbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
        //return $date;
    }

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function itinerary()
    {
        return $this->belongsTo('App\Itinerary');
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    public function scopeSpam($query)
    {
        return $query->where('spam', true);
    }

    public function scopeNotSpam($query)
    {
        return $query->where('spam', false);
    }

}
