<?php

namespace App;

use App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * @return string
     */
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
        'name', 'email', 'password', 'goods', 'gold', 'strength', 'dexterity', 'intelligence', 'stamina', 'charisma'
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

    /**
     * @return null
     */
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

    /**
     * Calculate level progress
     *
     * @return float|int
     */
    public function levelProgress(User $user)
    {
        $levelProgress = $user->experience / $user->experience_next_level * 100;
        $levelProgress = round($levelProgress, 0);

        if ($levelProgress >= 100) {
            $this->levelUp();
        }

        return $levelProgress;
    }

    /**
     * Level up the user
     */
    public function levelUp()
    {
        $user = Auth::user();

        if ($user->experience >= $user->experience_next_level) {
            // check how many extra levels are required
            // each level introduces the double amount of experience required for the next one

            $remaining_exp = $user->experience - $user->experience_next_level;
            // set the required experience for the next level
            $user->experience_next_level = round($user->experience_next_level * 1.5, 0);
            $user->experience = round($remaining_exp, 0);

            // increase the level
            $user->unallocated_stats = $user->unallocated_stats + 5;
            $user->level = $user->level + 1;

            // save the changes
            $user->save();
        }
    }

    /**
     * @return mixed
     */
    public function isIn()
    {
        $user = Auth::user();
        $location = $user->location_id;
        $settlement = App\Settlement::findOrFail($location);

        return $settlement;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function onMap()
    {
        $user = Auth::user();

        return $this->hasOne(Map::class, 'user_id')->find($user->on_map);
    }

    public function totalCrew()
    {
        $ships = $this->hasMany(Ship::class)->getResults();
        $crew = 0;
        foreach ($ships as $ship) {
            $sailors = $ship->current_sailors;
            $crew = $crew + $sailors;
        }

        return $crew;
    }
}
