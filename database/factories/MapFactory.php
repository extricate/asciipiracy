<?php

use Faker\Generator as Faker;

$factory->define(App\Map::class, function (Faker $faker) {

    $type = 'small';
    $map_id = Uuid::generate();
    $tiles = factory('App\MapTile', 100)->create([
        'map_id' => $map_id,
    ]);

    return [
        'type' => $type,
        'map_id' => $map_id,
    ];
});
