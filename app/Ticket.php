<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id', 'id');
    }

    public function coupon()
    {
        return $this->hasOneThrough('App\Coupon', 'App\Event', 'id', 'event_id', 'event_id', 'id');
    }

    public function getTicketByEventId($id)
    {
        return $this->where('event_id', $id)
                    ->get();
    }

    public function storeTicket($value)
    {
        if($value){
            return $this->insert($value);
        }
        return false;
    }

    public function updateTicket($value, $id)
    {
        unset($value['id']);
        return $this->where('id', $id)
                    ->update($value);
    }

    public function getTicketById($id)
    {
        return $this->with(['event' => function($query){
                        $query->select('*');
                    }])
                    ->with(['coupon' => function($query){
                        $query->select('*');
                    }])
                    ->where('id', $id)
                    ->first();
    }

    public function getTopEvent()
    {
        return $this->where([
                        ['start_time', '<=', Carbon::now()],
                        ['sold', '>', '0']
                    ])
                    ->select('event_id', DB::raw('SUM(sold) as total_sold'))
                    ->groupBy('event_id')
                    ->orderBy('total_sold', 'desc')
                    ->limit(6)
                    ->get();
    }
}
