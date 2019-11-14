<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    protected $fillable = [
        'title',
        'publish_time',
        'start_time',
        'end_time',
        'location',
        'address',
        'summary',
        'description',
        'image',
        'type',
        'category',
        'image_3d',
        'eo_id',
        'status'
    ];
    
    protected $table = 'events';

    #region get All events according to the conditions
    public function getAllEvent()
    {
        return $this->where('publish_time', '>=', Carbon::now())
                    ->where('end_time', '>=', Carbon::now()->subDays(180))
                    ->where('status', 'not like', '2')
                    ->where('status', 'not like', '3')
                    ->get();
    }
    #endregion

    #region create Event
    public function storeEvent($eventArr)
    {
        if($eventArr)
        {
            return $this->create($eventArr);
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
            return $this->where($queryParams)
                        ->orderBy('start_time', 'asc')
                        ->get();
        }
        return false;
    }
    #endregion

    #region Get Event by Id
    // Will be used in other functions
    public function getEventById($params)
    {
        if($params)
        {
            try
            {
                $result = $this->findOrFail($params);   
            }
            catch(Exception $e)
            {
                $result = 'QUERY_NOT_FOUND';
            }
        }
        return $result; 
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
