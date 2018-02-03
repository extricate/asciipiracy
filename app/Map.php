<?php

namespace App;

use App\User;
use App\MapTile;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $mapArray = Array();
    protected $map = Array();
    public $tileSet = Array();

    /**
     * @var array
     */
    protected $fillable = [
        'id'
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Create a map
     *
     * @param int $x
     * @param int $y
     */
    public function generate(int $id, int $x, int $y)
    {
        $user = Auth::user();
        $map_id = Uuid::generate();
        $tileAmount = $x * $y;

        factory('App\Map')->create([
            'id' => $map_id,
            'user_id' => $id,
        ]);

        factory('App\MapTile', $tileAmount)->create([
            'belongs_to_map' => $map_id,
        ]);

        $user->on_map = $map_id;
        $user->save();
    }

    public function settlement(int $id)
    {
        $user = Auth::user();
    }

    /**
     * Tiles belonging to this map
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tiles(Map $map)
    {
        return $map->hasMany(MapTile::class, 'belongs_to_map')->getResults();
    }
}
