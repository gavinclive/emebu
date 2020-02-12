<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventViews;
use App\Ticket;
use App\Transaction;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $event;
    private $ticket;
    private $view;
    private $transaction;

    public function __construct()
    {
        $this->event = new Event();
        $this->ticket = new Ticket();
        $this->view = new EventViews();
        $this->transaction = new Transaction();
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
            'publish_time' => (new DateTime($request->input('publish_time')))->add(new DateInterval('PT7H')),
            'start_time' => (new DateTime($request->input('start_time')))->add(new DateInterval('PT7H')),
            'end_time' => (new DateTime($request->input('end_time')))->add(new DateInterval('PT7H')),
            'location' => $request->input('location'),
            'location_guide' => $request->input('location_guide') ? $request->input('location_guide') : '',
            'summary' => $request->input('summary'),
            'description' => $request->input('description'),
            'type_id' => $request->input('type_id'),
            'category_id' => $request->input('category_id'),
            'eo_id' => $request->input('eo_id'),
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
                if (array_key_exists('id', $ticketArr)) unset($ticketArr['id']);
                $ticketArr['start_time'] = (new DateTime($ticketArr['start_time']))->add(new DateInterval('PT7H'));
                $ticketArr['end_time'] = (new DateTime($ticketArr['end_time']))->add(new DateInterval('PT7H'));
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
        $this->view->addView($id);
        return response()->json(['success' => true, 'result' => $this->event->getEventById($id)], 200);
    }

    public function update(Request $request)
    {
        $eventArr = [
            'title' => $request->input('title'),
            'publish_time' => (new DateTime($request->input('publish_time')))->add(new DateInterval('PT7H')),
            'start_time' => (new DateTime($request->input('start_time')))->add(new DateInterval('PT7H')),
            'end_time' => (new DateTime($request->input('end_time')))->add(new DateInterval('PT7H')),
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
                $updateId = $ticketArr['id'];
                unset($ticketArr['id']);
                $ticketArr['start_time'] = (new DateTime($ticketArr['start_time']))->add(new DateInterval('PT7H'));
                $ticketArr['end_time'] = (new DateTime($ticketArr['end_time']))->add(new DateInterval('PT7H'));
                $ticketArr['event_id'] = $request->input('id');
                $ticketArr['updated_at'] = Carbon::now();
                $ticketArr['created_at'] = Carbon::now();
                $this->ticket->updateTicket($ticketArr, $updateId);
            }
        }

        return response()->json(['success' => true], 200);
    }

    public function destroy($id)
    {
        $hardDelete = false;
        $tickets = $this->ticket->getTicketByEventId($id);
        foreach($tickets as $ticket) {
            $transac = $this->transaction->getTransactionByEventId($ticket['id']);
            if ($transac->isEmpty()) {
                $hardDelete = true;
                break;
            }
        }
        $deleteEvent = $this->event->deleteEventById($id, $hardDelete);

        if (!$deleteEvent) {
            return response()->json(['success' => false, 'errMessage' => 'Delete failed'], 500);
        } 
        
        return response()->json(['success' => true], 200);
    }

    public function hideEvent(Request $request)
    {
        $this->event->updateEventById([
            'status' => '2'
        ], $request->input('id'));
    }

    public function investigateEvent(Request $request)
    {
        $this->event->updateEventById([
            'status' => '3'
        ], $request->input('id'));
    }

    public function reactivateEvent(Request $request)
    {
        $this->event->updateEventById([
            'status' => '1'
        ], $request->input('id'));
    }
}
