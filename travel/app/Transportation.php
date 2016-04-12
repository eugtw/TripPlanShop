<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportation extends Model {

	public function day()
    {
        return $this->hasOne('App\Day');
    }

}
