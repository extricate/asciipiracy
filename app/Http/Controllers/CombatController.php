<?php

namespace App\Http\Controllers;

use App;
use App\Ship;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CombatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // you are your own worst enemy... show user for index as its own enemy if there is no actual combat
        $enemy = $user;

        return view('combat.index', compact('enemy', 'user'));
    }

    public function log($action)
    {
        return view('combat.log', '$log');
    }
    public function startCombat()
    {
        $user = Auth::user();

        // create the enemy
        $enemy = factory(Ship::class)->make();
        $generateSailorAmount = $enemy->min_sailors;
        // populate the enemy ship with crew
        factory(App\Person::class, $generateSailorAmount)->make([
            'ships_id' => $enemy->id
        ]);

        return view('combat.index', compact('enemy', 'user'));
    }

    public function attack()
    {
        // to attack we line up a broadside
        // and then we shoot
        // and then another attack is available
    }

    public function escape()
    {
        // to escape we first move towards the wind
        // then the ships race based on their escape stat and certain random events
        // if the escape is successful, the escape ends the combat scenario immediately (no win or lose) with endCombat()
    }

    public function surrender()
    {
        // to surrender we just end the fight and lose
    }

    public function board()
    {
        // to board we first approach for 1 turn
        // then we grapple for 1 turn
        // then we fight on deck for 2 turns,
        // during which we get to choose to retreat and end the boarding and return to the combat (based on escape stat and random events)
        // then the winner gets to claim the other ship
    }

    public function sink()
    {
        // to sink, our hull must first be penetrated
        // then the ship must flood faster than the pumps can pump the water away
        // and then we sink
    }

    // End scenario's, these all end with endCombat().
    public function win()
    {
        // to win the opponent must either: surrender or sink
    }

    public function lose()
    {
        // to lose you must either: surrender or sink
    }

    public function capture()
    {
        // capture is the winning scenario for boarding
    }
}
