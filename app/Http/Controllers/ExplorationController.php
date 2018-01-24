<?php

namespace App\Http\Controllers;

use App\Ship;
use App\Person;
use App\User;
use App\Eventslist;
use Illuminate\Http\Request;

class ExplorationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $event = (object)array(
            'title' => 'Events will appear here',
            'body' => '',
            'effect' => '',
            );
        return view('explore.index', compact('event', 'user'));
    }

    public function goExplore(User $user, Ship $ship)
    {
        $gold = $user->gold;
        $event = (object)array(
            'id' => '1',
            'title' => 'Treasure found!',
            'body' => 'You sell the booty for some gold!',
            'effect' => $gold + 100,
            );
        return view('explore.index', compact('event', 'user', 'ship'));
    }
}
