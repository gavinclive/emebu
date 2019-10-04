<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $event;

    public function __construct()
    {
        $this->event = new Event();
    }

    public function index()
    {
        if(!$this->event->getAllEvent())
        {
            return response()->json(['success' => false, 500]);
        }
        return response()->json(['success' => true, 'result' => $this->event->getAllEvent()], 200);
    }

    public function store (Request $request)
    {
        $eventArr = [
            'title' => $request->input('title'),
            'start_time' => $request->input('startTime'),
            'end_time' => $request->input('endTime'),
            'location' => $request->input('location'),
            'summary' => $request->input('summary'),
            'description' => $request->input('description'),
            'image' => $request->input('image'),
            'type' => $request->input('type'),
            'category' => $request->input('category'),
            'organizer_id' => $request->input('organizerId')
        ];

        $this->event->storeEvent($eventArr);

        $tickets = $request->input('ticket');
        $ticketArr = array();

        foreach($tickets as $ticket)
        {
            
            if($ticket)
            {
                $ticketArr[key($ticket)] = current($ticket);
            }
            else
            {
                $ticketArr[key($ticket)] = '';
            }

            if (key($ticket) == 'desc') 
            {
                $this->ticket->storeTicket($ticketArr);
            }
        }
    }
}
