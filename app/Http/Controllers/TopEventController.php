<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TopEventController extends Controller
{
    private $topEvent;
    
    public function __construct()
    {
        $this->topEvent = new Ticket();
    }

    public function index()
    {
        return response()->json(['success' => true, 'result' => $this->topEvent->getTopEvent()], 200);
    }
}
