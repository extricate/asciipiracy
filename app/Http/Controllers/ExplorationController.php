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

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(User $user)
    {
        $event = (object)array(
            'id' => '',
            'title' => 'Events will appear here',
            'body' => 'When you set out on an exploration, you will encounter random events here',
            'effect_on' => '',
            'effect' => '',
            'effect_changed' => '',
            );
        return view('explore.show', compact('event'));
    }

    /**
     * Go explore
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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

            $event = Exploration::latest()->get;

            if ($event->effect_on == 'gold') {
                $user->gold = $event->effect;
                $user->save();
            }
            elseif ($event->effect_on == 'goods') {
                $user->goods = $event->effect;
                $user->save();
            }
            elseif ($event->effect_on == 'ship_hp') {
                $activeShip = $user->activeShip();
                $activeShip->current_health = $event->effect;
                $activeShip->save();
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
            return view('explore.show', compact('event'));
        }
    }
}
