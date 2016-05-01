<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class ItiDayPlace extends Model {

	protected $table = 'itiday_places';

    protected $guarded = ['id', 'created_at'];

    protected $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function getExperiencesAttribute()
    {
        return  explode(',', $this->attributes['experiences']);
    }

    public function day()
    {
        return $this->belongsTo('App\ItiDay');
    }

    public function letterLabel()
    {

        $places = ItiDayPlace::where('itiday_id', $this->itiday_id)->get();
        $place_index = array_search($this->toArray(), $places->toArray());
        $letter = substr($this->letters, $place_index, 1);
        return  $letter;
    }

}
