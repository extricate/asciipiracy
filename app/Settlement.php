<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    public function services()
    {
        return $this->hasMany(Ship::class, 'ships_id');
    }
}
