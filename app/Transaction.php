<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

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

    public function event()
    {
        return $this->hasOneThrough('App\Event', 'App\Ticket', 'event_id', 'id', 'ticket_id', 'id');
    }

    public function getAllTransaction()
    {
        return $this->with(['ticket' => function($query) {
                        $query->select('*');
                    }])
                    ->with(['event' => function($query){
                        $query->select('*');
                    }])
                    ->get();
                    
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
                ->with(['event' => function($query){
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
                            'settled_at' => Carbon::now()
                        ]);
        }

        return false;
    }
}
