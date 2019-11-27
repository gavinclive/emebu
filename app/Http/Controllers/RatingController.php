<?php

namespace App\Http\Controllers;

use App\Event;
use App\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    private $event;
    private $rating;

    public function __construct()
    {
        $this->event = new Event();
        $this->rating = new Rating();
    }

    public function store(Request $request)
    {
        $this->event->giveRating($request->input('event_id'), $request->input('point'));
    }

    public function checkExist(Request $request)
    {
        return response()->json(['success' => true, 'result' => $this->rating->ratingExist($request->input('event'), $request->input('member'))], 200);
    }

    public function show($id)
    {
        return response()->json(['success' => true, 'result' => $this->event->getRating($id)], 200);
    }

    public function getEoRating(Request $request)
    {
        return response()->json(['success' => true, 'result' => $this->event->getAllAvgRating($request->input('id'))], 200);
    }
}
