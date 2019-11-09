<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    private $coupon;
    public function __construct()
    {
        $this->coupon = new Coupon();
    }

    public function show($value)
    {
        if(!$this->coupon->getAllCoupon($value))
        {
            return response()->json(['success' => false, 500]);
        }
        return response()->json(['success' => true, 'result' => $this->coupon->getAllCoupon($value)], 200);
    }
}
