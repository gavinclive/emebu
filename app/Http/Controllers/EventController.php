<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store (Request $request)
    {
        $tickets = $request->input('ticket');
        
        foreach($tickets as $a) {
            dd(key($a).current($a));
        }
    }
}
