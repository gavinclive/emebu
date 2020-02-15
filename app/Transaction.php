<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $guarded = [];

    protected $casts = [
        'id' => 'string'
    ];

    public function ticket()
    {
        return $this->belongsTo('App\Ticket', 'ticket_id', 'id');
    }

    public function coupon()
    {
        return $this->hasOne('App\Coupon', 'id', 'coupon_id');
    }

    public function event()
    {
        return $this->hasOneThrough('App\Event', 'App\Ticket', 'event_id', 'id', 'ticket_id', 'id');
    }

    public function member()
    {
        return $this->belongsTo('App\User', 'member_id', 'id');
    }

    public function getAllTransaction()
    {
        if (Auth::user()->role === '1') {
            return $this->with(['ticket' => function($query) {
                            $query->select('*');
                        }])
                        ->with(['event' => function($query){
                            $query->select('*');
                        }])
                        ->with(['coupon' => function($query) {
                            $query->select('*');
                        }])
                        ->with(['member' => function($query) {
                            $query->select('*');
                        }])
                        ->where('member_id', Auth::user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        } else {
            return $this->with(['ticket' => function($query) {
                            $query->select('*');
                        }])
                        ->with('event')
                        ->whereHas('event',
                            function (Builder $query) {
                                $query->where('eo_id', Auth::user()->id);
                            })
                        ->with(['coupon' => function($query) {
                            $query->select('*');
                        }])
                        ->with(['member' => function($query) {
                            $query->select('*');
                        }])
                        ->orderBy('created_at', 'desc')
                        ->get();
        }
        
                    
    }

    public function storeTransaction($value)
    {
        if ($value) 
        {
            return $this->insertGetId($value);
        }

        return false;
    }

    public function getTransactionById($id)
    {
        return $this->with(['ticket' => function($query) {
                    $query->select('*');
                }])
                ->with(['event' => function($query) {
                    $query->select('*');
                }])
                ->with(['coupon' => function($query) {
                    $query->select('*');
                }])
                ->where('id', $id)
                ->first();
    }

    public function settleTransactionById($id)
    {
        if ($id)
        {
            return $this->where('id', $id)
                        ->update([
                            'settled_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
        }

        return false;
    }

    public function getTransactionByMemberId ($id, $condition)
    {
        if ($condition === 'past') 
        {
            $timeframe = ['event.end_time', '<=', Carbon::now()];
        } else {
            $timeframe = ['end_time', '>', Carbon::now()];
        }
        return $this->with(['ticket' => function($query) {
                    $query->select('*');
                }])
                ->with(['event' => function($query){
                    $query->select('*');
                }])
                ->with(['coupon' => function($query) {
                    $query->select('*');
                }])
                ->where([
                    $timeframe,
                    ['member_id', $id]
                ])
                ->orderBy('created_at', 'desc')
                ->get();
    }

    public function getTransactionByEventId ($id)
    {
        return $this->where('ticket_id', $id)
                    ->get();
    }
}
