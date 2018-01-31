<?php

use Faker\Generator as Faker;

$factory->define(App\Settlement::class, function (Faker $faker) {

    $inhabitants = $faker->biasedNumberBetween(50, 250000, function($x) { return 1 - sqrt($x); });
    if ($inhabitants < 100) { $settlementType = 1; }
    elseif ($inhabitants < 1000) { $settlementType = 2; }
    elseif ($inhabitants < 5000) { $settlementType = 3; }
    elseif ($inhabitants < 10000) { $settlementType = 4; }
    elseif ($inhabitants < 20000) { $settlementType = 5; }
    elseif ($inhabitants < 30000) { $settlementType = 6; }
    elseif ($inhabitants < 50000) { $settlementType = 7; }
    else { $settlementType = 8; }

    return [
        'name' => $faker->city(),
        'type' => $settlementType,
    ];
});
