<?php

namespace App;

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
        return $this->paginate(10);
    }

    public function storeEvent($eventArr)
    {
        if($eventArr)
        {
            return $this->create($eventArr);
        }
       return false;
    }
}
