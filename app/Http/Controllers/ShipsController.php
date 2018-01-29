<?php

namespace App\Http\Controllers;

use App;
use App\Ship;
use App\Person;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ships = Ship::latest()->get();
        return view('ships.index', compact('ships'));
    }

    /**
     * Create a new ship
     *
     * @return \Response
     */
    public function create()
    {
        // get the calling user's ID to associate the ship
        $user = Auth::user();

        // check if user has ship slots left
        if ($this->checkShipCapacity() == false) {
            return redirect('home')->with('message', 'You already have the maximum amount of ships you can have!');
        }

        // get user gold and reduce by the correct amount; if the user has enough, continue the script
        $shipPrice = 1000;
        $gold = $user->gold;
        if ($user->gold >= $shipPrice) {
            // deduct price of ship
            $user->gold = $gold - $shipPrice;
            $user->save();

            // create the ship
            $ship = factory(App\Ship::class)->create([
                'user_id' => $user->id
            ]);

            // populate the ship with crew
            $generateSailorAmount = $ship->min_sailors;
            factory(App\Person::class, $generateSailorAmount)->create(['ships_id' => $ship->id]);
            $user->active_ship = $ship->id;
            $user->save();

            return redirect('home')->with('message', 'Ship successfully purchased and set as active!');
        } else {
            return redirect('home')->with('message', 'You don\'t have enough gold, scrub');
        }
    }

    /**
     * Ship made to specifications
     *
     * @param Ship $ship
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createToSpecs(Ship $ship)
    {
        // get the calling user's ID to associate the ship
        $specifications = $ship;
        $user = Auth::user();

        // check if user has ship slots left
        if ($this->checkShipCapacity() == false) {
            return redirect('home')->with('message', 'You already have the maximum amount of ships you can have!');
        }

        // create the ship based on the specifications
        if ($user->myShips()->count() == 0) {
            $createShip = factory(App\Ship::class)->create([
                'user_id' => $user->id,
                'is_beginner_ship' => false,
                'length' => $specifications->length,
                'masts' => $specifications->masts,
                'min_sailors' => $specifications->min_sailors,
                'max_sailors' => $specifications->max_sailors,
                'decks' => $specifications->decks,
                'beam' => $specifications->beam,
                'draught' => $specifications->draught,
                'cannons' => $specifications->cannons,
                'cannon_caliber' => $specifications->cannon_caliber,
                'gunports' => $specifications->gunports,
                'total_hold' => $specifications->total_hold,
                'maneuverability' => $specifications->maneuverability,
                'max_speed' => $specifications->max_speed,
                'current_health' => $specifications->maximum_health,
                'maximum_health' => $specifications->maximum_health,
            ]);
            $generateSailorAmount = $createShip->max_sailors;
            // populate the ship with crew
            factory(App\Person::class, $generateSailorAmount)->create([
                'ships_id' => $createShip->id
            ]);

            $user->active_ship = $createShip->id;
            $user->save();

            return redirect('home')->with('message', 'Beginner ship created and set to active!');
        } else {
            return redirect('home')->with('message', 'Something went wrong. Perhaps you already have a beginner ship?');
        }
    }

    /**
     * Create a beginner ship
     *
     * @return \Response
     */
    public function createBeginner()
    {
        $user = Auth::user();

        if ($user->myShips()->count() == 0) {
            $ship = factory(App\Ship::class)->create([
                'user_id' => $user->id,
                'is_beginner_ship' => true,
                'length' => 80,
                'masts' => 2,
                'min_sailors' => 20,
                'max_sailors' => 20,
                'decks' => 1,
                'beam' => 20,
                'draught' => 7,
                'cannons' => 10,
                'cannon_caliber' => 1,
                'gunports' => 10,
                'total_hold' => 2000,
                'maneuverability' => 5,
                'max_speed' => 12,
                'current_health' => 100,
                'maximum_health' => 100,
            ]);
            $generateSailorAmount = $ship->min_sailors;
            // populate the ship with crew
            factory(App\Person::class, $generateSailorAmount)->create([
                'ships_id' => $ship->id
            ]);

            $user->active_ship = $ship->id;
            $user->save();

            return redirect('home')->with('message', 'Beginner ship created and set to active!');
        } else {
            return redirect('home')->with('message',
                'Something went wrong. Perhaps you already have a beginner ship or any other ship? You can only create a beginner ship if you have no other ships.');
        }
    }

    /**
     * Check if user has capacity for more ships
     * @return bool
     */
    public function checkShipCapacity()
    {
        if (Auth::user()->myShips()->count() >= Auth::user()->max_ships) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ship $ship
     * @return \Illuminate\Http\Response
     */
    public function show(Ship $ship)
    {
        return view('ships.show', compact('ship'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ship $ship
     * @return \Illuminate\Http\Response
     */
    public function edit(Ship $ship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Ship $ship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ship $ship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find the correct ship
        $ship = Ship::findOrFail($id);

        // delete the ship
        $ship->delete();

        return redirect('home')->with('message', 'Ship successfully sunk!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setActiveShip($id)
    {
        $user = Auth::user();

        if ($user->is_in_combat == false) {
            $user->active_ship = $id;
            $user->save();
        } else {
            return redirect(route('home'))->with('message',
                'You might want to finish your fight before you try to magically change your ship!');
        }

        return back();
    }

    /**
     * Repair ship
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function repairShip($id)
    {
        $user = Auth::user();
        $ship = Ship::findOrFail($id);
        $cost = $ship->repairCost($ship);

        if ($user->id != $ship->user_id) {
            return redirect(route('home'))->with('message', 'That is NOT your ship you filthy hacker!');
        }

        if ($user->is_in_combat == false) {
            if ($user->gold >= $cost) {
                $ship->repairShip($ship);

                return redirect(route('home'))->with('message', 'Ship repaired!');
            } else {
                return redirect(route('home'))->with('message', 'You do not have enough gold for that repair!');
            }
        } else {
            return redirect(route('home'))->with('message',
                'Captain, you might want to consider finishing your fight before thinking about repairs?!');
        }
    }
}
