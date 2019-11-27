<?php

namespace App\Http\Controllers;

use App\Event;
use App\FeaturedEvent;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeaturedEventController extends Controller
{
    private $featuredEvent;
    private $event;

    public function __construct()
    {
        $this->featuredEvent = new FeaturedEvent();
        $this->event = new Event();
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
            $i = 0;
            $j = 0;
            $k = 0;
            foreach($request->input('media_upload') as $media_upload) {
                $k++;
                $imageName = '';
                if ($media_upload === 'false' && $request->input('img')[$i]) {
                    $imageName = $request->input('img')[$i];
                    $i++;
                } else if ($media_upload === 'true') {
                    $image = $request->file('img')[$j];
                    $imageName = time().$image->getClientOriginalName();
                    $image->move('storage/uploads/feat/', $imageName);
                    $j++;
                } else {
                    $i++;
                }
                if ($imageName) {
                    $feat = [
                        'content' => $imageName,
                        'key' => 'featured_'.$k,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                    $this->featuredEvent->storeFeaturedEvent($feat);
                }
            }
        } catch (Exception $e) {
            DB::rollBack();
        } finally {
            DB::commit();
        }
    }
}
