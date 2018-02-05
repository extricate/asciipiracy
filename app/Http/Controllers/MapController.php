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
            'x' => 'required|int|min:5|max:5',
            'y' => 'required|int|min:5|max:5'
        ]);

        if ($validator->fails()) {
            return redirect(route('map'))->with('error', 'It appears you tried to make an illegal request.');
        }

        $x = $request->x;
        $y = $request->y;
        $user = Auth::user();
        $totalCrew = $user->totalCrew();

        if ($totalCrew > $user->goods) {
            return redirect(route('map'))->with('error', 'We do not appear to have enough goods for that journey!');
        }

        $user->goods = $user->goods - $totalCrew;
        $user->save();

        // delete previous map of user
        if ($user->on_map != '99700d20-08c5-11e8-a6a2-6d79bfaed767') {
            $old_map_id = $user->on_map;
            $old_map = App\Map::findOrFail($old_map_id);
            $old_map->delete();
        }
        // continue generating new map
        $id = $user->id;

        $map = new Map;
        $map->generate($id, $x, $y);

        return redirect(route('map'))->with('message',
            'Successfully traveled to a new region. ' . $totalCrew . ' goods were used on the journey');
    }

    /**
     * @param $tileID
     * @return \Illuminate\Http\RedirectResponse
     */
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

                // we do not reset the tile, because users are allowed to travel between towns multiple times
                return redirect(route('visit_town'))->with('message', 'You travelled to a new town!');
            } else {
                return redirect(route('map'))->with('error', 'You cheater, that is not a town');
            }
        } else {
            return redirect(route('map'))->with('error', 'That is not your tile');
        }
    }

    /**
     * @param $tileID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function greetShip($tileID)
    {
        // check if the tile ID matches the map that belongs to the requesting user
        $user = Auth::user();
        $mapID = $user->on_map;
        $map = App\Map::findOrFail($mapID);
        $tile = App\MapTile::findOrFail($tileID);

        // greet a ship, can be a positive or negative event, or a fight

        if ($map->id == $tile->belongs_to_map) {
            if ($tile->type == 'ship') {
                // reset the tile
                $tile->type = 'water';
                $tile->save();

                // ship greet event logic, selecting from various possibilities
                $types = array('merchant' => 50, 'pirate' => 30, 'gambler' => 30, 'drifter' => 10);

                $weightedTypes = array();
                foreach ($types as $weightedType => $value) {
                    $weightedTypes = array_merge($weightedTypes, array_fill(0, $value, $weightedType));
                }
                $selectedType = $weightedTypes[array_rand($weightedTypes)];

                if ($selectedType == 'merchant') {
                    $user->intelligence = $user->intelligence + 2;
                    $user->save();

                    return redirect(route('map'))->with('message',
                        'You encountered a friendly merchant. He shared some trade secrets with you! ' . '<label class="label label-intelligence>Intelligence +2</label>"');

                } elseif ($selectedType == 'pirate') {
                    return redirect(route('start_combat'))->with('message',
                        'Arg! They are pirates! Prepare for a fight!');

                } elseif ($selectedType == 'gambler') {
                    $user->gold = $user->gold + 200;
                    $user->save();

                    return redirect(route('map'))->with('message',
                        'You encountered a friendly sailor. He invited you to play a game of dice. You won some gold. ' . '<label class="label label-gold>+ 200 gold</label>"');

                } elseif ($selectedType == 'drifter') {
                    return redirect(route('map'))->with('message',
                        'You encountered a drifting ship, with no signs of any crew on board... you decided to leave the ship well enough alone, for you fear that whatever might be on board could potentially cause you more harm than any good.');

                } else {
                    return redirect(route('map'))->with('message', 'Something something ship');
                }
            } else {
                return redirect(route('map'))->with('error', 'You cheater, that is not a ship');
            }
        } else {
            return redirect(route('map'))->with('error', 'That is not your tile');
        }
    }


    /**
     * @param $tileID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function findGoods($tileID)
    {
        // check if the tile ID matches the map that belongs to the requesting user
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

                // reset the tile
                $tile->type = 'water';
                $tile->save();

                return redirect(route('map'))->with('message', 'You find ' . $foundGoods . ' goods.');
            } elseif ($tile->type == 'treasure') {
                $treasure = rand($user->level * 1000, $user->level * 2000);
                $user->gold = $user->gold + $treasure;
                $user->save();

                // reset the tile
                $tile->type = 'island';
                $tile->save();

                return redirect(route('map'))->with('message',
                    'You lucky rascal! You find ' . $treasure . ' gold in a buried chest!');
            } else {
                return redirect(route('map'))->with('error', 'You cheater, those are not floating goods');
            }
        } else {
            return redirect(route('map'))->with('error', 'That is not your tile');
        }
    }
}
