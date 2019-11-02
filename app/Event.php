<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
                    ->paginate(10);
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
        if($params)
        {
            return $this->where([
                ['title', 'like', '%'.$params['title'].'%'],
                ['type', 'like', '%'.$params['type'].'%'],
                ['category', 'like', '%'.$params['category'].'%'],
                ['status', '=', $params['status'],
                ['end_time', '>=', Carbon::now()->subDays(180)].
                ['publish_time', '>=', Carbon::now()]]
            ]);
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
