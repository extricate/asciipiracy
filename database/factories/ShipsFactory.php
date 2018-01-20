<?php

use Faker\Generator as Faker;

$factory->define(App\Ship::class, function (Faker $faker) {

    $minSailors = $faker->numberBetween($min = 20, $max = 240);
    $maxSailors = $minSailors + $faker->numberBetween($min = 20, $max = 240);

    $masts = $faker->numberBetween($min = 1, $max = 4);
    $propulsion = $masts * $faker->numberBetween($min = 1, $max = 10);

    $draught = $faker->numberBetween($min = 5, $max = 30);
    $beam = $faker->numberBetween($min = 10, $max = 60);

    // Maximum speed is determined based on draught, beam, and propulsion amount
    $maxSpeed = $propulsion - ($draught / 10) * ($beam / 10);

    return [
        'name' => $faker->name,
        'cannons' => $faker->numberBetween($min = 0, $max = 320),
        'total_hold' => $faker->numberBetween($min = 0, $max = 20000),
        'constructed_at' => $faker->numberBetween($min = 1530, $max = 1640),
        'story' => $faker->paragraph,
        'min_sailors' => $minSailors,
        'max_sailors' => $maxSailors,
        'max_speed' => $maxSpeed,
        'masts' => $masts,
        'propulsion' => $propulsion,
        'decks' => $faker->numberBetween($min = 1, $max = 4),
        'length' => $faker->numberBetween($min = 80, $max = 1000),
        'draught' => $draught,
        'beam' => $beam,
        'maneuverability' => $faker->numberBetween($min = 1, $max = 20)

    ];
});
