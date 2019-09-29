<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $table = 'types';

    public function getAllEventTypes()
    {
        return $this->all();
    }
}
