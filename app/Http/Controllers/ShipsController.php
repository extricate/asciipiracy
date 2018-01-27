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
        $this->middleware('auth')->except(['index', 'show']);
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

        // get user gold and reduce by the correct amount; if the user has enough, continue the script
        $shipPrice = 1000;
        $gold = $user->gold;
        if ($user->gold >= $shipPrice) {
            $user->gold = $gold - $shipPrice;
            $user->save();

            // gold has been deducted, create the ship

            $ship = factory(App\Ship::class)->create([
                'user_id' => $user->id
            ]);
            $generateSailorAmount = $ship->min_sailors;
            // populate the ship with crew
            factory(App\Person::class, $generateSailorAmount)->create(['ships_id' => $ship->id]);

            $user->active_ship = $ship->id;
            $user->save();

            return redirect('home');
        }

        else {
            return redirect('home');
        }
    }

    /**
     * Create a new ship
     *
     * @return \Response
     */
    public function createBeginner()
    {
        // get the calling user's ID to associate the ship
        $user = Auth::user();

        if ($user->myShips()->count() == 0) {
            $ship = factory(App\Ship::class)->create([
                'user_id' => $user->id,
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

            return redirect('home');
        } else {
            return redirect('home');
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

        return redirect('home');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setActiveShip($id)
    {
        $user = Auth::user();
        $user->active_ship = $id;
        $user->save();

        return back();
    }
}
