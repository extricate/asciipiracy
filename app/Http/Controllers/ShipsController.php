<?php

namespace App\Http\Controllers;

use App\Ship;
use App\Person;
use APp\User;
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
     */
    public function create()
    {
        $user = Auth::user();

        $ship = factory('App\Ship')->create([
            'user_id' => $user->id
        ]);
        $generateSailorAmount = $ship->min_sailors;

        factory('App\Person', $generateSailorAmount)->create(['ships_id' => $ship->id]);
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function show(Ship $ship)
    {
        return view('ships.show', compact('ship'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function edit(Ship $ship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ship  $ship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ship $ship)
    {
        $rules = array(
            'gold' => 'numeric'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ship = Ship::findOrFail($id);
        $ship_id = $ship->id;

        $crew = Person::findOrFail($ship_id)->first();

        $ship->delete();
        $crew->delete();

        return redirect('home');
    }
}
