<?php

namespace App\Http\Controllers;

use App;
use App\Map;
use App\User;
use App\MapTile;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('combat.status');
        $this->middleware('has.active.ship', ['except' => ['index', 'show']]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('map.show', compact('user'));
    }

    public function show()
    {
        $user = Auth::user();
        $map = $user->onMap();

        return $map->tiles();
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function travel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'x' => 'required|int|min:1|max:50',
            'y' => 'required|int|min:1|max:50'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'It appears you tried to make an illegal request.');
        }

        $x = $request->x;
        $y = $request->y;
        $user = Auth::user();
        $id = $user->id;

        $map = new Map;
        $map->generate($id, $x, $y);

        return view('map.show', compact('user'));
    }

    public function travelTo($tileID)
    {
        $user = Auth::user();
        $mapID = $user->on_map;
        $map = App\Map::findOrFail($mapID);
        $tile = App\MapTile::findOrFail($tileID);

        if ($map->id == $tile->belongs_to_map) {
            if ($tile->type == 'settlement') {
                $user->location_id = $tile->settlement;
                $user->save();

                return redirect(route('visit_town'))->with('message', 'You travelled to a new town!');
            } else {
                return back()->with('error', 'You cheater, that is not a town');
            }
        } else {
            return back()->with('error', 'That is not your tile');
        }
    }

    public function findGoods($tileID)
    {
        // Check if the tile ID matches the map that belongs to the requesting user
        $user = Auth::user();
        $mapID = $user->on_map;
        $map = App\Map::findOrFail($mapID);
        $tile = App\MapTile::findOrFail($tileID);

        if ($map->id == $tile->belongs_to_map) {
            if ($tile->type == 'goods') {
                $user->level;
                $foundGoods = rand($user->level, $user->level * 50);

                $user->goods = $user->goods + $foundGoods;
                $user->save();

                $tile->type = 'water';
                $tile->save();

                return back()->with('message', 'You find ' . $foundGoods . ' goods.');
            } else {
                return back()->with('error', 'You cheater, those are not floating goods');
            }
        } else {
            return back()->with('error', 'That is not your tile');
        }
    }
}
