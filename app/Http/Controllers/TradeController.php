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
        $this->middleware('has.active.ship', ['only' => ['trade', 'buyCannons']]);
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

            $ship = $user->activeShip();
            $ship->free_hold = $ship->free_hold - $goods;
            $ship->save();

            return back()->with('trade', 'You have purchased ' . $goods . ' goods for ' . $totalAmount . ' gold. The goods will be loaded on the ' . $ship->name);
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
            if ($ship->cannons + $cannons <= $ship->gunports) {
                $ship->cannons = $ship->cannons + $cannons;
                $ship->save();
                $user->gold = $user->gold - $totalAmount;
                $user->save();
                return back()->with('trade',
                    'You have purchased ' . $cannons . ' cannons for ' . $totalAmount . ' gold.');
            } else {
                return back()->with('error',
                    'It appears your ship does not have enough gunports for this amount of cannons.');
            }
        } else {
            return back()->with('error', 'It appears you do not have enough money for that purchase.');
        }
    }

    public function trade(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'string',
            'quantity' => 'int',
            'type' => 'string|in:tobacco,furs,gemstones,textiles,alcohol,sugar,spices,ivory,coffee,mahogany',
        ]);
        if ($validator->fails()) {
            return redirect(route('general_store'))->with('error', 'It appears you tried to make an illegal request.');
        }

        $user = Auth::user();
        $city = $user->isIn();
        $ship = $user->activeShip();

        if ($request->action == 'buy') {
            $type = $request->type;

            if ($request->quantity > $city->{$type . '_stock'}) {
                return redirect(route('general_store'))->with('trade',
                    'That is more than we have stocked I am afraid.');
            } elseif ($request->quantity > $ship->free_hold) {
                return redirect(route('general_store'))->with('trade',
                    'It appears your ship does not have the required amount of free hold for this quantity of ' . $type);
            }
            $type_sell_price = $city->{$type . '_buy'};
            $total_price = $request->quantity * $type_sell_price;

            if ($total_price > $user->gold) {
                return redirect(route('general_store'))->with('trade',
                    'It looks like you cannot afford this amount. I am afraid that we do not work on a credit basis. Perhaps take out a loan somewhere?');
            } else {
                $user->gold = $user->gold - $total_price;
                $user->save();

                $city->{$type . '_stock'} = $city->{$type . '_stock'} - $request->quantity;
                $city->save();

                // add goods to ship
                $ship->$type = $ship->$type + $request->quantity;

                // deduct goods from free hold
                $ship->free_hold = $ship->free_hold - $request->quantity;
                $ship->save();

                return redirect(route('general_store'))->with('trade',
                    'Thank you for your purchase sir. Your acquired goods will be loaded on the ' . $ship->name);
            }
        } elseif ($request->action == 'sell') {
            $type = $request->type;

            if ($request->quantity > $ship->$type) {
                return redirect(route('general_store'))->with('trade',
                    'I do not do speculative trading. I really need to get the quantity of goods I am buying.');
            }

            $type_sell_price = $city->{$type . '_sell'};
            $total_price = $request->quantity * $type_sell_price;

            $user->gold = $user->gold + $total_price;
            $user->save();

            $city->{$type . '_stock'} = $city->{$type . '_stock'} + $request->quantity;
            $city->save();

            $ship->$type = $ship->$type - $request->quantity;
            $ship->free_hold = $ship->free_hold + $request->quantity;
            $ship->save();

            return redirect(route('general_store'))->with('trade',
                'Thank you for your business, sir. Your acquired goods will be offloaded from the ' . $ship->name);
        }

    }

    public function shipsAvailable()
    {
        $sale = factory('App\Ship', 3)->make();

        return view('settlement.stores.shipwright.ship-store', compact('sale'));
    }

    public function buyShip()
    {
        $user = Auth::user();
    }
}
