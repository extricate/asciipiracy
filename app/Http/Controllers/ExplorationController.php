<?php

namespace App\Http\Controllers;

use App;
use App\Ship;
use App\Person;
use App\User;
use App\Events;
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
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goExplore()
    {
        // Get the user ID so that it can be used to update the database, same goes for the ship
        $user = Auth::user();
        $ship = $user->getActiveShip();
        // Primary things that can change for users are created local
        $explorationCost = 10;

        // check if the user has an active ship, else return the no ship event
        if ($user->getActiveShip() == !null) {
            if ($user->goods >= $explorationCost) {
                // update the users goods to deduct the price of the exploration
                // which will eventually be based on both the duration of the exploration and the size of the ship/crew
                $user->goods = $user->goods - $explorationCost;
                $user->save();

                // retrieve an event
                $event = Events::find(['id' => '6'])->first();

                // analyse the event
                $affects = $event->affects;
                $effect_on = $event->effect_on;
                $effect = $event->effect;
                $type = $event->type;

                $currentUser = $user;
                $currentShip = $ship;

                if ($event->type != 'system')
                {
                    // construct the effect of the event if it's not a system event
                    $this->processEvent($affects, $effect_on, $type, $effect);
                }

                return view('explore.show', compact('event'));

            } else {
                $event = Events::find(['id' => '2'])->first();

                return view('explore.show', compact('event'));

            }
        } else {
            $event = Events::find(['id' => '1'])->first();

            return view('explore.show', compact('event'));
        }
    }

    /**
     * @param string $affects
     * @param string $effect_on
     * @param string $type
     * @param string $effect
     */
    public function processEvent($affects, $effect_on, $type, $effect)
    {
        // determine type of affects to localize the correct object
        if ($affects == 'user') {
            $affects = Auth::user();
        } elseif ( $affects == 'ship' ) {
            $affects == Auth::user()->getActiveShip();
        }

        // process the actual event
        if ($type == '+') {
            $affects->{$effect_on} = $affects->{$effect_on} + $effect;
            $affects->save();
        } elseif ($type == '-') {
            $$affects->{$effect_on} = $affects->{$effect_on} - $effect;
            $$affects->save();
        }

        return;
    }
}
