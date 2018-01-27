<?php

namespace App\Http\Controllers;

use App;
use App\Ship;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CombatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $ship = $user->activeShip();

        // check if user has an active ship, else show an error message and exit scenario
        if ($user->activeShip() == null) {
            $message = 'You do not have an active ship!';
            return view('combat.index', compact('user', 'ship', '$enemy', 'message'));
        }

        if ($user->is_in_combat == false) {
            // if the user is not in combat yet, create a new enemy
            $enemy = $this->createEnemy();
            $user->is_in_combat = true;
            $user->is_in_combat_with = $enemy->id;
            $user->save();

            // show the message that the user encountered a new enemy
            $message = 'You encounter an enemy pirate ship called ' . $enemy->name;
        } else {
            $enemy = $target = Ship::findOrFail($user->is_in_combat_with);

            // show the message that the user encountered a new enemy
            $message = 'You are fighting the ' . $enemy->name;
        }

        return view('combat.show', compact('user', 'ship', 'enemy', 'message'));
    }

    public function log($action)
    {
        // push the action to the log
        array_push($logs, $action);

        return view('combat.log', '$logs');
    }

    public function startCombat()
    {
        $user = Auth::user();
        $ship = $user->activeShip();

        // check if user has an active ship, else show an error message
        if ($user->activeShip() == null) {
            $message = 'You do not have an active ship!';
            return view('combat.index', compact('user', 'ship', '$enemy', 'message'));
        }

        // create the opponent for the combat scenario
        //$enemy = $this->createEnemy();

        return view('combat.show', compact('enemy', 'user', 'ship', 'message'));
    }

    public function createEnemy()
    {
        // create the enemy
        $enemy = factory(Ship::class)->create();
        $generateSailorAmount = $enemy->min_sailors;
        // populate the enemy ship with crew
        factory(App\Person::class, $generateSailorAmount)->create([
            'ships_id' => $enemy->id
        ]);

        return $enemy;
    }

    /**
     * User attacks the ship it is in combat with
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function attack()
    {
        $user = Auth::user();

        if ($user->is_in_combat == true) {
            $origin = $user->activeShip();
            $enemy = Ship::findOrFail($user->is_in_combat_with);

            $accuracy = array(
                'grazes' => rand(0.500, 0.625),
                'glances' => rand(0.625, 0.750),
                'hits' => rand(0.750, 1.000),
                'penetrates' => rand(1.000, 1.250),
                'smashes' => rand(1.250, 1.490),
                'wrecks' => 3.000
            );

            $selected_accuracy = array_rand($accuracy, 1);
            $actual_accuracy = $accuracy[$selected_accuracy];

            $damage = $origin->attackStatistics($origin) * $actual_accuracy;

            if ($enemy->current_health <= $damage) {
                $enemy->delete();
                $this->win();
            } else {
                $enemy->current_health = $enemy->current_health - $damage;
                $enemy->save();
            }
            $ship = $origin;

            return redirect(route('view_combat'))->with('message', 'You infliced ' . $damage . ' damage on the ' . $enemy->name);

        } else {
            // user is not in combat, redirect to the combat show without doing anything
            return redirect(route('combat.show'));
        }
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

    public function sink($id)
    {
        //
    }

    // End scenario's, these all end with endCombat().
    public function win()
    {
        $user = Auth::user();
        $ship = $user->activeShip();
        // to win the opponent must either: surrender or sink
        $user->combat_wins++;

        // find the correct ship
        $enemy = Ship::findOrFail($user->is_in_combat_with);

        // delete the ship
        $enemy->delete();

        $user->is_in_combat = false;
        $user->is_in_combat_with = 0;
        $user->save();

        return redirect(route('combat_end'))->with('message', 'You win!');
    }

    public function lose()
    {
        $user = Auth::user();
        $ship = $user->activeShip();

        // to lose you must either: surrender or sink
        $user->combat_losses++;
    }

    public function capture()
    {
        // capture is the winning scenario for boarding
    }

    public function endCombat()
    {
        // End the combat scenario
        $user = Auth::user();

        $user->is_in_combat = false;
        $user->is_in_combat_with = 0;
        $user->save();

        return redirect(route('home'));
    }
}
