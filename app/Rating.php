<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $guarded = [];

    public function ratingExist($event, $member)
    {
        return $this->where([
                        ['rateable_id', $event],
                        ['user_id', $member]
                    ])
                    ->first();
    }
}
