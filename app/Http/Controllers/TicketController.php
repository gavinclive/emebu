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

    public function show($id)
    {
        if(!$this->ticket->getTicketById($id))
        {
            return response()->json(['success' => false, 500]);
        }
        return response()->json(['success' => true, 'result' => $this->ticket->getTicketById($id)], 200);
    }
}
