<?php

namespace App\Http\Controllers;

use App\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    private $eventType;

    public function __construct()
    {
        $this->eventType = new EventType();
    }

    public function index()
    {
        if(!$this->eventType->getAllEventTypes())
        {
            return response()->json(['success' => false], 500);
        }
        return response()->json(['success' => true, 'result' => $this->eventType->getAllEventTypes()], 200);
    }
}
