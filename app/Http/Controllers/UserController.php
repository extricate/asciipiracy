<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function allocateStats($stat)
    {
        $user = Auth::user();
        if ($user->unallocated_stats >= 1) {
            $user->unallocated_stats = $user->unallocated_stats - 1;
            if ($stat == 'strength') {
                $user->strength = $user->strength + 1;
            } elseif ($stat == 'dexterity') {
                $user->dexterity = $user->dexterity + 1;
            } elseif ($stat == 'intelligence') {
                $user->intelligence = $user->intelligence + 1;
            } elseif ($stat == 'stamina') {
                $user->stamina = $user->stamina + 1;
            } elseif ($stat == 'charisma') {
                $user->charisma = $user->charisma + 1;
            } else {
                return redirect(route('home'))->with('message', 'Something went terribly wrong.');
            }
            $user->save();
        }

        return redirect(route('home'))->with('message', 'Not enough status points!');
    }
}
