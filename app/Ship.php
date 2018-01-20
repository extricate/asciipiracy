<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/ships/' . $this->id;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fireCannons()
    {

    }
}
