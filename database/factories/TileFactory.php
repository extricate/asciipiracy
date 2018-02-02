<?php

use Faker\Generator as Faker;

$factory->define(App\MapTile::class, function (Faker $faker) {

    // kind of maps
    // settlement
    // water
    // specific ship

    $type = 'water';

    if ($type == 'settlement') {
        $settlement = factory('App\Settlement')->create();
    } elseif ($type == 'ship') {
        $ship = factory('App\Ship')->create();
    } else {
        $settlement = (object)array('id' => '0');
        $ship = (object)array('id' => '0');
    }

    return [
        'type' => $type,
        'settlement' => $settlement->id,
        'ship' => $ship->id,
    ];
});
