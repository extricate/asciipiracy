<?php

namespace App\Http\Controllers;

use App;
use App\Ship;
use App\Person;
use App\User;
use App\Events;
use App\Http\Controllers\CombatController;
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
            'type' => '',
            'affects' => '',
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
        $ship = Auth::user()->activeShip();

        // check if the user has an active ship, else return the no ship event
        if ($user->is_in_combat == true) {
            return redirect(route('view_combat'))->with('message',
                'You might want to finish the fight before you go on another adventure captain!');
        }
        if ($user->activeShip() == !null) {

            $explorationCost = $ship->explorationCost();

            if ($user->goods >= $explorationCost) {
                // update the users goods to deduct the price of the exploration
                // which will eventually be based on both the duration of the exploration and the size of the ship/crew
                $user->goods = $user->goods - $explorationCost;
                $user->exploration_count++;

                // add exploration experience
                $user->experience = $user->experience + $explorationCost;
                $user->save();

                // retrieve a random event weighted by frequency
                $event = Events::where('frequency', ">", 0)->orderByRaw("-LOG(RAND()) / Frequency")->first();

                // analyse the event
                $affects = $event->affects;
                $effect_on = $event->effect_on;
                $effect = $event->effect;
                $type = $event->type;

                // first check if the event is a combat event because then we want to initialize the combat scenario
                if ($event->type == 'combat') {
                    return redirect(route('view_combat'));
                }

                if ($event->type != 'system') {
                    // construct the effect of the event if it's not a system event
                    $this->processEvent($affects, $effect_on, $type, $effect);
                }

                return view('explore.show', compact('event'));
            } else {
                // return not enough goods event
                $event = Events::find(['id' => '2'])->first();

                return view('explore.show', compact('event'));
            }
        } else {
            // return no ship event
            $event = Events::find(['id' => '1'])->first();

            return view('explore.show', compact('event'));
        }
    }

    /**
     * Process events
     *
     * @param string $affects
     * @param string $effect_on
     * @param string $type
     * @param string $effect
     */
    public function processEvent($affects, $effect_on, $type, $effect)
    {
        $user = Auth::user();
        $ship = Auth::user()->activeShip();

        // determine type of affects to localize the correct object
        if ($affects == 'user') {
            $affects = $user;
        } elseif ($affects == 'ship') {
            $affects = $ship;
        }

        // process the actual event
        if ($type == '+') {
            $affects->{$effect_on} = $affects->{$effect_on} + $effect;
            $affects->save();
        } elseif ($type == '-') {
            $affects->{$effect_on} = $affects->{$effect_on} - $effect;
            $affects->save();
        } elseif ($type == '*') {
            $affects->{$effect_on} = $affects->{$effect_on} - $effect;
            $affects->save();
        } elseif ($type == '/') {
            $affects->{$effect_on} = $affects->{$effect_on} - $effect;
            $affects->save();
        }

        // check if any special conditions apply now and process or remedy them.
        if ($ship->current_health <= 0) {
            // apparently the ship sank, tough luck
            $ship->delete();
        }

        if ($ship->cannons > $ship->gunports) {
            // apparently we got too much cannons now. Let's restore that.
            $ship->cannons = $ship->gunports;
            $ship->save();
        }

        if ($ship->current_health > $ship->maximum_health) {
            // apparently the ship has more health than the maximum now. Let's restore that.
            $ship->current_health = $ship->maximum_health;
            $ship->save();
        }

        return;
    }
}
