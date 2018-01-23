<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CombatController extends Controller
{
    public function attack()
    {
        // to attack we line up a broadside
        // and then we shoot
        // then we reload
        // and then another attack is available
    }

    public function escape()
    {
        // to escape we first move towards the wind
        // then we race
        // and then we end the combat scenario
    }

    public function surrender()
    {
        // to surrender we just end the fight and lose
    }

    public function board()
    {
        // to board we first approach
        // then we grapple
        // then we fight on deck
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
        // to win the opponent must either: surrender, sink or escape
    }

    public function lose()
    {
        // to lose you must either: surrender, sink or escape
    }

    public function capture()
    {
        // capture is the winning scenario for boarding
    }
}
