<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    private $report;

    public function __construct()
    {
        $this->report = new Report();
    }

    public function store (Request $request)
    {
        $this->report->storeReport([
            'event_id' => $request->input('event_id'),
            'description' => $request->input('report') ? $request->input('report') : '',
            'member_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
        $count = $this->report->countReport($request->input('event_id'));
        if ($count === 10) {
            $this->event->updateEventById([
                'status' => '3'
            ], $request->input('id'));
        }
    }

    public function index ()
    {
        return response()->json(['success' => true, 'result' => $this->report->getAllReport()], 200);
    }
}
