<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeaturedEvent extends Model
{
    protected $table = 'static_contents';
    protected $guarded = [];

    public function getAllFeaturedEvent()
    {
        return $this->where('key', 'like', 'featured_%')
                    ->orderBy('key', 'asc')
                    ->get();
    }

    public function storeFeaturedEvent($values)
    {
        if ($values) {
            return $this->insert($values);
        }

        return false;
    }

    public function deleteAllFeaturedEvent()
    {
        return $this->where('key', 'featured_')
                    ->delete();
    }
}
