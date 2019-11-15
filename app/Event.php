<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    protected $guarded =[];
    
    protected $table = 'events';

    public function ticket()
    {
        return $this->hasMany('App\Ticket');
    }

    public function eo()
    {
        return $this->belongsTo('App\User', 'eo_id', 'id');
    }

    public function coupon()
    {
        return $this->hasOne('App\Coupon', 'event_id', 'id');
    }
    #region get All events according to the conditions
    public function getAllEvent()
    {
        return $this->with(['ticket' => function($query) {
                        $query->select('qty as total');
                    }])
                    ->where([
                        ['publish_time', '<=', Carbon::now()],
                        ['end_time', '>=', Carbon::now()->subDays(180)],
                        ['status', 'not like', '2'],
                        ['status', 'not like', '3']
                    ])
                    ->get();
    }
    #endregion

    #region create Event
    public function storeEvent($eventArr)
    {
        if($eventArr)
        {
            return $this->insertGetId($eventArr);
        }
       return false;
    }
    #endregion

    #region Search
    //Search event by parameter (by title/type/category/status)
    public function getEventByParam($params)
    {
        $params = json_decode($params);
        $queryParams = array();
        if($params)
        {
            if ($params->title) {
                array_push($queryParams, ['title', 'like', '%'.$params->title.'%']);
            }
            if ((int) $params->type) {
                array_push($queryParams, ['type_id', '=', (int) $params->type]);
            }
            if ((int) $params->category) {
                array_push($queryParams, ['category_id', '=', (int) $params->category]);
            }
            if ((int) $params->status) {
                array_push($queryParams, ['status', '=', (int) $params->status]);
            }
            if ((int) $params->role == 1) {
                array_push($queryParams, ['end_time', '>=', Carbon::now()->subDays(180)], ['publish_time', '>=', Carbon::now()]);
            } else {
                array_push($queryParams, ['eo_id', '=', (int) $params->id]);
            }
            return $this->with(['ticket' => function($query) {
                            $query->select('*');
                        }])
                        ->with(['coupon' => function($query){
                            $query->select('*');
                        }])
                        ->where($queryParams)
                        ->orderBy('start_time', 'asc')
                        ->get();
        }
        return false;
    }
    #endregion

    #region Get Event by Id
    // Will be used in other functions
    public function getEventById($id)
    {
        return $this->with(['eo' =>function($query) {
                        $query->select('id', 'username', 'image');
                    }])
                    ->with(['ticket' => function($query) {
                        $query->where([
                                    ['start_time', '<=', Carbon::now()],
                                    ['end_time', '>=', Carbon::now()]
                                ])
                                ->select('*');
                    }])
                    ->where('id', '=', $id)
                    ->get();
    }
    #endregion

    #region Update Event
    public function updateEventById($eventArr, $id)
    {
        if($eventArr && $id)
        {
            return $this->where('id', $id)->update($eventArr);
        }
        return false;
    }
    #endregion

}
