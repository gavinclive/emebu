<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];

    protected $table = 'coupons';

    #region get all Coupons by eventId
    public function getAllCoupon($eventId)
    {
        return $this->join('events', 'events.id', '=', 'coupons.event_id')
                    ->where('coupons.event_id', '=', $eventId)
                    ->get();
    }
    #endregion

    public function storeCoupon($value)
    {
        return $this->insert($value);
    }

    public function editCouponById($id)
    {
        $result = false;
        if ($id) {
            try {
                $result = $this->findOrFail($id);
            } catch (Exception $e) {
                $result = 'QUERY_NOT_FOUND';
            }
        }
        return $result;
    }

    public function updateCoupon($value, $id)
    {
        return $this->where('id', '=', $id)
                    ->update($value);
    }
}
