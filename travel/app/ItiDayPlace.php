<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class ItiDayPlace extends Model {

	protected $table = 'itiday_places';

    protected $guarded = ['id', 'created_at'];


    public function getExperiencesAttribute()
    {
        return  explode(',', $this->attributes['experiences']);
    }

    public function day()
    {
        return $this->belongsTo('App\ItiDay');
    }


}
