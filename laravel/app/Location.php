<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

    protected $fillable = ['*'];

    public function day()
    {
        return $this->belongsToMany('App\Day');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
