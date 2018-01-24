<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        return $this->hasOne(Ship::class)->first();
    }

    /**
     * Go explore
     *
     * @param  User $user
     * @return \Response
     */
    public function goExplore(User $user)
    {
        // Get the user ID so that it can be used to update the database
        $id = $user->id;
        // Primary things that can change for users are created local
        $goods = $user->goods;
        $gold = $user->gold;

        $explorationCost = 10;

        if ($user->goods >= $explorationCost) {
            // Update the users goods to deduct the price of the exploration
            // Which will eventually be based on both the duration of the exploration and the size of the ship/crew
            $user = User::findOrFail($id);
            $user->goods = $goods - $explorationCost;
            $user->save();

            // Generate the event
            $event = (object)array(
                'id' => '1',
                'title' => 'Treasure found!',
                'body' => 'You sell the booty for some gold!',
                'effect' => $gold + 100,
            );
            return view('explore.show', compact('event'));
        }
        else {
            $event = (object)array(
                'id' => '0',
                'title' => 'Not enough goods!',
                'body' => 'You cannot travel without goods, you will surely perish!',
                'effect' => null
            );
            return view('explore.index', compact('event'));
        }
    }
}
