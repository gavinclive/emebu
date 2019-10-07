<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    private $ticket;

    public function __construct()
    {
        $this->ticket = new Ticket();
    }

    public function show()
    {
        if(!$this->ticket->getTicketByEventId($event_id))
        {
            return response()->json(['success' => false, 500]);
        }
        return response()->json(['success' => true, 'result' => $this->event->getTicketByEventId()], 200);
    }
}
