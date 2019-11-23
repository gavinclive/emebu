<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

    public function store(Request $request)
    {
        $arrCoupon = [
            'code' => $request->code,
            'qty' => $request->qty,
            'daily_reset' => $request->daily_reset ? '0' : '1',
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'rate' => $request->rate,
            'max_cut' => $request->max_cut,
            'event_id' => $request->event_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $storeCoupon = $this->coupon->storeCoupon($arrCoupon);
        
        if(!$storeCoupon) {
            return response()->json(['success' => false], 500);
        }

        return response()->json($storeCoupon, 200);
    }

    public function edit($id)
    {
        $editCoupon = $this->coupon->editCouponById($id);

        if (!$editCoupon || $editCoupon == 'QUERY_NOT_FOUND') {
            return response()->json(['success' => false, 'errCode' => 'QUERY_NOT_FOUND']);
        }

        return response()->json($editCoupon, 200);
    }

    public function update(Request $request, $id)
    {
        $arrCoupon = [
            'qty' => $request->qty,
            'daily_reset' => $request->daily_reset ? '0' : '1',
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'updated_at' => Carbon::now()
        ];

        $updateCoupon = $this->coupon->updateCoupon($arrCoupon, $id);
        
        if(!$updateCoupon) {
            return response()->json(['success' => false], 500);
        }

        return response()->json($updateCoupon, 200);
    }

    public function checkCoupon(Request $request)
    {
        $result = $this->coupon->checkCoupon([
                    'code' => $request->input('code') ? $request->input('code') : '',
                    'id' => $request->input('id')
                ]);

        if (!$result) {
            return response()->json(['success' => false, 'errCode' => 'NO_COUPON'], 500);
        }

        return response()->json(['success' => true, 'result' => $result], 200);
    }
}
