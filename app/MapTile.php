<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class MapTile extends Model
{
    protected $fillable = [
        'belongs_to_map'
    ];

    public function map()
    {
        $this->belongsTo('App\Map', 'map_id');
    }
}
