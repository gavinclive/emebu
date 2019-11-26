<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class EventViews extends Model
{
    protected $table = 'event_views';
    protected $guarded = [];

    public function addView($id)
    {
        $record = $this->where('event_id', $id)->first();
        if (!$record['id']) {
            $this->insert([
                'view' => 0,
                'event_id' => $id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        } else {
            $view = $record['view'];
            $this->where('id', $record['id'])
                ->update([
                    'view' => $view + 1,
                ]);
        }

    }

    public function getViewById($id)
    {
        return $this->where('event_id', $id)
                    ->first();
    }
}
