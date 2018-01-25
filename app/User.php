<?php

namespace App;

use App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    public function path()
    {
        return '/users/' . $this->id;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'goods', 'gold'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Fetch all ships owned by this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function myShips()
    {
        return $this->hasMany(Ship::class)->getResults();
    }

    /**
     * Fetch the currently active ship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function activeShip()
    {
        $user = Auth::user();
        return $this->hasOne('App\Ship')->find($user->active_ship);
    }

    public function getActiveShip()
    {
        $user = Auth::user();

        $activeShipID = $user->active_ship;

        if ($activeShipID >= 0) {
            $activeShip = App\Ship::findOrFail($activeShipID);
        }
        else {
            return null;
        }


        return $activeShip;

    }
}
