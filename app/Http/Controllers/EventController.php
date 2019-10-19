<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
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
            'type' => $request->input('type'),
            'category' => $request->input('category'),
            'organizer_id' => $request->input('organizerId')
        ];
        if($request->has('img') && $request->file('img'))
        {
            $image = $request->file('img');
            $imageName = time().$image->getClientOriginalName();
            $image->move('storage/uploads/events/', $imageName);
            $eventArr = $imageName;
        }
        $this->event->storeEvent($eventArr);
        $tickets = $request->input('ticket');
        $ticketArr = array();
        foreach($tickets as $ticket)
        {
            if(current($ticket))
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

    public function show($values)
    {
        if(gettype($values == 'object'))
        {
            if(!$this->event->getEventByParam($values))
            {
                return response()->json(['success' => false], 500);
            }
            return response()->json(['success' => true, 'result' => $this->event->getEventByParam($values)], 200);
        }
        else
        {
            $result = $this->getEventById($values);
            if($result == 'QUERRY_NOT_FOUND' || !$result)
            {
                return response()->json(['success' => false], 500);
            }
            return response()->json(['success' => true, 'result' => $this->event->getEventById($values)], 200);
        }
    }

    public function edit($id)
    {
        $result = $this->getEventById($id);
            if($result == 'QUERRY_NOT_FOUND' || !$result)
            {
                return response()->json(['success' => false], 500);
            }
            return response()->json(['success' => true, 'result' => $this->event->getEventById($id)], 200);
    }

    public function update(Request $request)
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
            'category' => $request->input('category')
        ];

        if($request->has('img') && $request->file('img'))
        {
            $image = $request->file('img');
            $imageName = time().$image->getClientOriginalName();
            $image->move('storage/uploads/events/', $imageName);
        }

        $this->event->updateEventById($eventArr, $request->input('id'));
    }
}
