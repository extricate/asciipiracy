<?php

use Faker\Generator as Faker;

$factory->define(App\MapTile::class, function (Faker $faker) {

    // kind of maps
    // settlement
    // water
    // specific ship


    $types = array('settlement' => 4, 'water' => 50, 'ship' => 10, 'goods' => 10, 'island' => 10, 'treasure' => 2);

    $weightedTypes = array();
    foreach ($types as $weightedType => $value) {
        $weightedTypes = array_merge($weightedTypes, array_fill(0, $value, $weightedType));
    }

    $selectedType = $weightedTypes[array_rand($weightedTypes)];

    $settlement = null;
    $ship = null;

    if ($selectedType == 'settlement') {
        $settlement = factory('App\Settlement')->create();
        $settlement = $settlement->id;
    }

    if ($selectedType == 'ship') {
        $ship = factory('App\Ship')->create();
        $generateSailorAmount = $ship->min_sailors;
        factory('App\Person', $generateSailorAmount)->create(['ships_id' => $ship->id]);

        $ship = $ship->id;
    }


    return [
        'type' => $selectedType,
        'settlement' => $settlement,
        'ship' => $ship,
    ];
});
