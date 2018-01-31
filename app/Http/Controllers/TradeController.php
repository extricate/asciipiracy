<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('combat.status');
    }

    public function buyGoods(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'goods' => 'required|int|min:1'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'It appears you tried to make an illegal request.');
        }

        $user = Auth::user();
        $price = 5;

        $goods = $request->input('goods');

        $totalAmount = $goods * $price;

        if ($user->gold >= $totalAmount) {
            $user->goods = $user->goods + $goods;
            $user->gold = $user->gold - $totalAmount;
            $user->save();

            return back()->with('trade', 'You have purchased ' . $goods . ' goods for ' . $totalAmount . ' gold.');
        } else {
            return back()->with('error', 'It appears you do not have enough money for that purchase.');
        }
    }

    public function buyCannons(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cannons' => 'required|int|min:1'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'It appears you tried to make an illegal request.');
        }

        $user = Auth::user();
        $ship = $user->activeShip();
        $price = 600;
        $cannons = $request->input('cannons');
        $totalAmount = $cannons * $price;

        if ($user->gold >= $totalAmount) {
            if ($ship->cannons + $cannons <= $ship->gunports)
            {
                $ship->cannons = $ship->cannons + $cannons;
                $ship->save();
                $user->gold = $user->gold - $totalAmount;
                $user->save();
                return back()->with('trade', 'You have purchased ' . $cannons . ' cannons for ' . $totalAmount . ' gold.');
            } else {
                return back()->with('error', 'It appears your ship does not have enough gunports for this amount of cannons.');
            }
        } else {
            return back()->with('error', 'It appears you do not have enough money for that purchase.');
        }
    }
}
