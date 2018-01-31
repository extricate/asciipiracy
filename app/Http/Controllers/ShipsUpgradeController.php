<?php

namespace App\Http\Controllers;

use App\Ship;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipsUpgradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('combat.status');
        $this->middleware('has.active.ship');
        $this->middleware('ship.has.bonus.points');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('ships.upgrade', compact('ship'));
    }

    public function upgrade(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gunports' => 'string|nullable',
            'max_health' => 'string|nullable',
            'max_sailors' => 'string|nullable'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'It appears you tried to make an illegal request.');
        }

        $user = Auth::user();
        $ship = $user->activeShip();

        if ($request->has('gunports')) {
            $ship->gunports = $ship->gunports + 2;
            $ship->upgrade_points = $ship->upgrade_points - 1;
            $ship->save();
            return redirect(route('shipwright'))->with('trade', 'You upgraded your gunports!');

        } elseif ($request->has('max_sailors')) {
            $ship->max_sailors = $ship->max_sailors + 10;
            $ship->upgrade_points = $ship->upgrade_points - 1;
            $ship->save();
            return redirect(route('shipwright'))->with('trade', 'You upgraded the maximum amount of sailors!');

        } elseif ($request->has('max_health')) {
            $ship->max_health = $ship->max_health + 20;
            $ship->upgrade_points = $ship->upgrade_points - 1;
            $ship->current_health = $ship->max_health;
            $ship->save();
            return redirect(route('shipwright'))->with('trade', 'You upgraded the maximum amount of ship hitpoints! As a service, I also ordered the carpenter to repair your ship.');

        } else {
            return redirect(route('shipwright'))->with('error', 'Invalid request');
        }

    }
}
