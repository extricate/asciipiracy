<?php

namespace App\Http\Controllers;

use App\Ship;
use App\Person;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExplorationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $event = (object)array(
            'title' => 'Events will appear here',
            'body' => '',
            'effect' => '',
            );
        return view('explore.index', compact('event', 'user'));
    }

    /**
     * Go explore
     *
     * @param  User $user
     * @return \Response
     */
    public function goExplore()
    {
        // Get the user ID so that it can be used to update the database
        $user = Auth::user();
        // Primary things that can change for users are created local
        $goods = $user->goods;
        $gold = $user->gold;

        $explorationCost = 10;

        if ($user->goods >= $explorationCost) {
            // Update the users goods to deduct the price of the exploration
            // Which will eventually be based on both the duration of the exploration and the size of the ship/crew
            $user->goods = $goods - $explorationCost;
            $user->save();

            // Generate the event
            // Currently there is only one event
            $event = (object)array(
                'id' => '1',
                'title' => 'Treasure found!',
                'frequency' => 1,
                'body' => 'You sell the booty for some gold!',
                'effect_on' => 'gold',
                'effect_changed' => '+ 100 gold',
                'effect' => $gold + 100,
            );

            if ($event->effect_on == 'gold') {
                $user->gold = $event->effect;
                $user->save();
            }
            elseif ($event->effect_on == 'goods') {
                $user->goods = $event->effect;
                $user->save();
            }
            else {
            }
            return view('explore.show', compact('event'));
        } else {
            $event = (object)array(
                'id' => '0',
                'title' => 'Not enough goods!',
                'frequency' => 1,
                'body' => 'You cannot travel without goods, you will surely perish!',
                'effect_on' => '',
                'effect_changed' => '',
                'effect' => null
            );
            return view('explore.index', compact('event'));
        }
    }
}
