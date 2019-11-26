<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    protected $guarded = [];

    public function member ()
    {
        return $this->hasOne('App\User', 'id', 'member_id');
    }

    public function event ()
    {
        return $this->hasOne('App\Event', 'id', 'event_id');
    }

    public function storeReport ($values)
    {
        return $this->insert($values);
    }

    public function getAllReport ()
    {
        return $this->with(['member' => function($query) {
                        $query->select('id', 'name');
                    }])
                    ->with(['event' => function($query) {
                        $query->select('id', 'title');
                    }])
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    public function countReport ($id)
    {
        return $this->where('event_id', $id)
                    ->count();
    }
}
