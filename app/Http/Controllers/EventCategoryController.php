<?php

namespace App\Http\Controllers;

use App\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    private $eventCategory;

    public function __construct()
    {
        $this->eventCategory = new EventCategory();
    }

    public function index()
    {
        if(!$this->eventCategory->getAllEventCategories())
        {
            return response()->json(['success' => false, 500]);
        }
        return response()->json(['success' => true, 'result' => $this->eventCategory->getAllEventCategories()], 200);
    }
}
