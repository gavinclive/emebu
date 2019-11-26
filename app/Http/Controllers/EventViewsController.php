<?php

namespace App\Http\Controllers;

use App\EventViews;
use Illuminate\Http\Request;

class EventViewsController extends Controller
{
    private $view;

    public function __construct()
    {
        $this->view = new EventViews();
    }

    public function show ($id)
    {
        return response()->json(['success' => true, 'result' => $this->view->getViewById($id)], 200);
    }
}
