<?php

namespace App\Http\Controllers;

use App\Event;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $event;
    private $ticket;

    public function __construct()
    {
        $this->event = new Event();
        $this->ticket = new Ticket();
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
            'publish_time' => $request->input('publishTime'),
            'start_time' => $request->input('startTime'),
            'end_time' => $request->input('endTime'),
            'location' => $request->input('location'),
            'location_guide' => $request->input('address'),
            'summary' => $request->input('summary'),
            'description' => $request->input('description'),
            'type_id' => $request->input('type'),
            'category_id' => $request->input('category'),
            'eo_id' => $request->input('organizerId')
        ];
        if($request->has('img') && $request->file('img'))
        {
            $image = $request->file('img');
            $imageName = time().$image->getClientOriginalName();
            $image->move('storage/uploads/events/', $imageName);
            $eventArr['image'] = $imageName;
        }
        if($request->has('img_3d') && $request->file('img_3d'))
        {
            $image = $request->file('img_3d');
            $imageName = time().$image->getClientOriginalName();
            $image->move('storage/uploads/events/', $imageName);
            $eventArr['image_3d'] = $imageName;
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
        if(!$this->event->getEventByParam($values))
        {
            return response()->json(['success' => false], 500);
        }
        return response()->json(['success' => true, 'result' => $this->event->getEventByParam($values)], 200);
    }

    public function edit($id)
    {
        $result = $this->getEventById($id);
            if($result == 'QUERY_NOT_FOUND' || !$result)
            {
                return response()->json(['success' => false], 500);
            }
            return response()->json(['success' => true, 'result' => $this->event->getEventById($id)], 200);
    }

    public function update(Request $request)
    {
        $eventArr = [
            'title' => $request->input('title'),
            'publish_time' => $request->input('publishTime'),
            'start_time' => $request->input('startTime'),
            'end_time' => $request->input('endTime'),
            'location' => $request->input('location'),
            'address' => $request->input('address'),
            'summary' => $request->input('summary'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'category' => $request->input('category'),
            'eo_id' => $request->input('organizerId')
        ];
        if($request->has('img') && $request->file('img'))
        {
            $image = $request->file('img');
            $imageName = time().$image->getClientOriginalName();
            $image->move('storage/uploads/events/', $imageName);
            $eventArr['image'] = $imageName;
        }
        if($request->has('img_3d') && $request->file('img_3d'))
        {
            $image = $request->file('img_3d');
            $imageName = time().$image->getClientOriginalName();
            $image->move('storage/uploads/events/', $imageName);
            $eventArr['image_3d'] = $imageName;
        }
        $this->event->updateEventById($eventArr, $request->input('id'));
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
}
