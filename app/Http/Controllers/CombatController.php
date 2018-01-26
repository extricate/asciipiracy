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

        // you are your own worst enemy... show user for index as its own enemy if there is no actual combat
        $enemy = $user;

        $error = 'You\'re currently not in a fight.';

        // check if user has an active ship, else show an error message
        if ($user->activeShip() == null) {
            $error = 'You do not have an active ship!';
            return view('combat.index', compact('user', 'ship', '$enemy', 'error'));
        }

        return view('combat.index', compact('user', 'ship', 'enemy', 'error'));
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
            $error = 'You do not have an active ship!';
            return view('combat.index', compact('user', 'ship', '$enemy', 'error'));
        }

        // create the opponent for the combat scenario
        $enemy = $this->createEnemy();

        $error = 'You inflicted ' . $this->attack($enemy->id) . ' damage on the enemy!';

        return view('combat.show', compact('enemy', 'user', 'ship', 'error'));
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
     * @param Ship $id
     * @return mixed
     */
    public function attack($id)
    {
        $user = Auth::user();
        $origin = $user->activeShip();
        $target = Ship::findOrFail($id);

        $origin_attack = $origin->attackStatistics($origin);
        //$target_attack = $target->attackStatistics($target);
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

        $damage = $origin_attack * $actual_accuracy;

        $target->current_hp - $damage;
        $target->save();

        return $damage;
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
        $user = Auth::user();
        $ship = $user->activeShip();

        // to win the opponent must either: surrender or sink
        $user->combat_wins++;
    }

    public function lose()
    {
        $user = Auth::user();
        $ship = $user->activeShip();

        // to lose you must either: surrender or sink
        $user->combat_wins++;
    }

    public function capture()
    {
        // capture is the winning scenario for boarding
    }
}
