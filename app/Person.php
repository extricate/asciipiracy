<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public function path()
    {
        return '/people/' . $this->id;
    }
}
