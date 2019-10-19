<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'start_time',
        'end_time',
        'location',
        'summary',
        'description',
        'image',
        'type',
        'category',
        'organizer_id',
        'status'
    ];
    
    protected $table = 'events';

    public function getAllEvent()
    {
        return $this->where('published_date', '>=', Carbon::now())
                    ->where('end_date', '>=', Carbon::now()->subDays(180))
                    ->paginate(10);
    }

    public function storeEvent($eventArr)
    {
        if($eventArr)
        {
            return $this->create($eventArr);
        }
       return false;
    }

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
                ['status', '=', $params['status']]
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
