<?php

namespace App\Http\Controllers;

use App;
use App\Ship;
use App\Person;
use App\User;
use App\Events;
use App\Settlement;
use App\Http\Controllers\CombatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettlementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('combat.status');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->location_id == null) {
            // user is currently not in a settlement, generate new one and return the user to that settlement

            // create the settlement
            $settlement = factory(App\Settlement::class)->create();

            $user->location_id = $settlement->id;
            $user->save();

            return view('settlement.index', compact('settlement', 'user'));
        } else {
            $user->location_id;
            $settlement = Settlement::findOrFail($user->location_id);

            return view('settlement.index', compact('settlement', 'user'));
        }
    }

    // all store services in the settlement
    public function general()
    {
        return view('settlement.stores.general');
    }

    public function carpenter()
    {
        return view('settlement.stores.carpenter');
    }

    public function shipwright()
    {
        return view('settlement.stores.shipwright');
    }

    public function tavern()
    {
        return view('settlement.stores.tavern');
    }

    // travel
    public function travel()
    {
        return view('travel.index');
    }
}
