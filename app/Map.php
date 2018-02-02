<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $mapArray = Array();
    protected $map = Array();
    public $tileSet = Array();

    /**
     * Create a map
     *
     * @param int $width
     * @param int $height
     */
    public function generate()
    {
        $width = 15;
        $height = 15;
        $x = 0;
        $y = 0;


        // to create a map, we first dictate its size in x and y

        $x = 0;
        $y = 0;

        // for the total amount of x * y we need to generate random tiles, we generate these at random using a factory.

        // next, we populate the map at random with objects that we generate, these can be anything ranging from settlements to specific enemies (generating settlements and enemies alike)

        $i = 0;
        // populate the map
        foreach ($width as $row)
        {
            foreach($row as $tile)
            {
                //
            }
        }

    }
}
