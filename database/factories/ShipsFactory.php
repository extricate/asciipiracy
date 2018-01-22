<?php

use Faker\Generator as Faker;

$factory->define(App\Ship::class, function (Faker $faker) {

    $minSailors = $faker->numberBetween($min = 20, $max = 240);
    $maxSailors = $minSailors + $faker->numberBetween($min = 20, $max = 240);

    $masts = $faker->numberBetween($min = 1, $max = 4);
    $propulsion = $masts * $faker->numberBetween($min = 40, $max = 200);

    $decks = $faker->numberBetween($min = 1, $max = 4);
    $beam = $faker->numberBetween($min = 20, $max = 70);
    $draught = ($decks + ($beam / 100)) * $faker->numberBetween($min = 5, $max = 10);
    $length = $decks * $faker->numberBetween($min = 20, $max = 250);
    if ($length >= 300) $masts++;
    if ($masts > 4) $masts--;

    $gunports = $decks * $faker->numberBetween($min = 0, $max = 42);
    // Make gunports amount an even amount
    if ($gunports % 2 == 1) $gunports++;
    $cannons = $faker->numberBetween($min = 0, $gunports);
    if ($cannons % 2 == 1) $cannons++;

    $cannon_caliber = $faker->numberBetween($min = 1, $max = 3);
    if ($gunports >= 50) $cannon_caliber++;
    if ($gunports >= 200) $cannon_caliber++;
    if ($length >= 300) $cannon_caliber++;

    $hull_speed = (1.34 * sqrt($length));
    $maxSpeed = $hull_speed;

    return [
        'name' => $faker->name,
        'cannons' => $cannons,
        'gunports' => $gunports,
        'class' => $faker->name,
        'type' => $faker->name,
        'cannon_caliber' => $cannon_caliber,
        'total_hold' => $faker->numberBetween($min = 0, $max = 20000),
        'constructed_at' => $faker->numberBetween($min = 1530, $max = 1640),
        'story' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'min_sailors' => $minSailors,
        'current_sailors' => $faker->numberBetween($minSailors, $maxSailors),
        'max_sailors' => $maxSailors,
        'max_speed' => $maxSpeed,
        'masts' => $masts,
        'propulsion' => $propulsion,
        'decks' => $decks,
        'length' => $length,
        'draught' => $draught,
        'beam' => $beam,
        'maneuverability' => $faker->numberBetween($min = 1, $max = 20)
    ];
});
