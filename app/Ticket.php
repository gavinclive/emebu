<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id', 'id');
    }

    public function getTicketByEventId($id)
    {
        return $this->getTicketByEventId($id);
    }

    public function storeTicket($value)
    {
        if($value){
            return $this->create($value);
        }
        return false;
    }

    public function updateTicket($value, $id)
    {
        unset($value['id']);
        return $this->where('id', '=', $id)
                    ->update($value);
    }
}
