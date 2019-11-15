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
            'publish_time' => $request->input('publish_time'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'location' => $request->input('location'),
            'location_guide' => $request->input('location_guide') ? $request->input('location_guide') : '',
            'summary' => $request->input('summary'),
            'description' => $request->input('description'),
            'type_id' => $request->input('type_id'),
            'category_id' => $request->input('category_id'),
            'eo_id' => $request->input('organizerId'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        if($request->has('image') && $request->file('image'))
        {
            $image = $request->file('image');
            $imageName = time().$image->getClientOriginalName();
            $image->move('storage/uploads/events/', $imageName);
            $eventArr['image'] = $imageName;
        }
        if($request->has('image_3d') && $request->file('image_3d'))
        {
            $image = $request->file('image_3d');
            $imageName = time().$image->getClientOriginalName();
            $image->move('storage/uploads/events/', $imageName);
            $eventArr['image_3d'] = $imageName;
        }
        $id = $this->event->storeEvent($eventArr);
        $tickets = $request->input('ticket');
        $ticketArr = array();
        foreach($tickets as $ticket)
        {
            $ticketArr[key($ticket)] = current($ticket) !== null ? current($ticket) : '';
            if (key($ticket) == 'description') 
            {
                $ticketArr['event_id'] = $id;
                $ticketArr['updated_at'] = Carbon::now();
                $ticketArr['created_at'] = Carbon::now();
                $this->ticket->storeTicket($ticketArr);
            }
        }

        return response()->json(['success' => true, 'result' => $id], 200);
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
        $result = $this->event->getEventById($id);
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
            'publish_time' => $request->input('publish_time'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'location' => $request->input('location'),
            'location_guide' => $request->input('location_guide') ? $request->input('location_guide') : '',
            'summary' => $request->input('summary'),
            'description' => $request->input('description'),
            'type_id' => $request->input('type_id'),
            'category_id' => $request->input('category_id'),
            'eo_id' => $request->input('eo_id'),
            'updated_at' => Carbon::now()
        ];
        if($request->has('image') && $request->file('image'))
        {
            $image = $request->file('image');
            $imageName = time().$image->getClientOriginalName();
            $image->move('storage/uploads/events/', $imageName);
            $eventArr['image'] = $imageName;
        }
        if($request->has('image_3d') && $request->file('image_3d'))
        {
            $image = $request->file('image_3d');
            $imageName = time().$image->getClientOriginalName();
            $image->move('storage/uploads/events/', $imageName);
            $eventArr['image_3d'] = $imageName;
        }
        $this->event->updateEventById($eventArr, $request->input('id'));
        $tickets = $request->input('ticket');
        $ticketArr = array();
        foreach($tickets as $ticket)
        {
            $ticketArr[key($ticket)] = current($ticket) !== null ? current($ticket) : '';
            if (key($ticket) == 'description') 
            {
                $ticketArr['updated_at'] = Carbon::now();
                $this->ticket->updateTicket($ticketArr, $ticketArr['id']);
            }
        }

        return response()->json(['success' => true], 200);
    }
}
