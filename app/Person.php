<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public function path()
    {
        #return '/people/' . str_replace(' ', '-', $this->name) . '-' . $this->id;
        return '/people/' . $this->id;
    }

    /**
     * People serve on ships
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servesOn()
    {
        return $this->belongsTo(Ship::class, 'ships_id');
    }
}
