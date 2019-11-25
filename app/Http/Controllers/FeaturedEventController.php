<?php

namespace App\Http\Controllers;

use App\FeaturedEvent;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeaturedEventController extends Controller
{
    private $featuredEvent;

    public function __construct()
    {
        $this->featuredEvent = new FeaturedEvent();
    }

    public function index()
    {
        if(!$this->featuredEvent->getAllFeaturedEvent())
        {
            return response()->json(['success' => false], 500);
        }

        return response()->json(['success' => true, 'result' => $this->featuredEvent->getAllFeaturedEvent()], 200);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->featuredEvent->deleteAllFeaturedEvent();
            $i = 1;
            foreach($request->input('id') as $arr) {
                $feat = [
                    'content' => $arr,
                    'key' => 'featured_'.$i,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                $this->featuredEvent->storeFeaturedEvent($feat);
                $i++;
            }
        } catch (Exception $e) {
            DB::rollBack();
        } finally {
            DB::commit();
        }
    }
}
