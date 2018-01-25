<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Ship;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $user = User::latest()->get();
        return view('user.index', compact('user'));
    }

    public function getActiveShip()
    {
        $user = Auth::user();

        $activeShipID = $user->active_ship;

        if ($activeShipID >= 0) {
            $activeShip = App\Ship::findOrFail($activeShipID);
        }
        else {
            return null;
        }


        return $activeShip;

    }
    public function makeActiveShip($ship)
    {
        $user = Auth::user();
        $user->active_ship = $ship->id;
        $user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
