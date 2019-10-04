<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable =
    [
        'name',
        'type',
        'qty',
        'price',
        'desc',
        'event_id'
    ];

    public function getTicketByEventId($event_id)
    {
        return $this->getTicketByEventId($event_id);
    }

    public function storeTicket($ticketArr)
    {
        if($ticketArr){
            return $this->create($ticketArr);
        }
        return false;
    }
}
