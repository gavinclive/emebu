<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'qty',
        'daily_reset',
        'start_time',
        'end_time',
        'rate',
        'max_cut'
    ];

    protected $table = 'coupons';

    #region get all Coupons by eventId
    public function getAllCoupon($eventId)
    {
        return $this->join('events', 'events.id', '=', 'coupons.event_id')
                    ->where('coupons.event_id', '=', $eventId)
                    ->get();
    }
    #endregion
}
