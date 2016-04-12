<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

    protected $fillable = ['user_id', 'itinerary_id', 'currency','purchase_price', 'is_read'];

    /** counting unread sale transaction record of a itinerary
     * @return string
     */
    public function scopeUnread()
    {
        return $this->where('is_read', 0);
    }
}
