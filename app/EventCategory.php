<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $table = 'categories';

    public function getAllEventCategories()
    {
        return $this->all();
    }
}
