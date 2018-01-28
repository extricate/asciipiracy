<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    public function players()
    {
        return $this->hasMany(User::class, 'location');
    }
    public function services()
    {
        //
    }
}
