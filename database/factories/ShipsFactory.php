<?php

use Faker\Generator as Faker;

$factory->define(App\Ship::class, function (Faker $faker) {

    $minSailors = $faker->biasedNumberBetween($min = 20, $max = 60, $function = 'sqrt');
    $maxSailors = $minSailors + $faker->biasedNumberBetween($min = 20, $max = 300, function ($x) {
            return 1 - sqrt($x);
        });

    $masts = $faker->biasedNumberBetween($min = 1, $max = 4, function ($x) {
        return 1 - sqrt($x);
    });
    $propulsion = $masts * $faker->numberBetween($min = 40, $max = 200);

    $decks = $faker->biasedNumberBetween($min = 1, $max = 4, function ($x) {
        return 1 - sqrt($x);
    });
    $length = $decks * $faker->numberBetween($min = 40, $max = 100);
    $beam = $faker->numberBetween($min = 10, $length / 4);
    $draught = ($decks + ($beam / 100)) * $faker->numberBetween($min = 5, $max = 10);

    if ($length >= 300) {
        $masts++;
    }
    if ($masts > 4) {
        $masts--;
    }

    $gunports = $decks * $faker->biasedNumberBetween($min = 2, $max = 42, function ($x) {
            return 1 - sqrt($x);
        });
    if ($gunports % 2 == 1) {
        $gunports++;
    } // Make gunports amount an even amount

    // add cannons
    $cannons = $gunports;

    $cannon_caliber = $faker->numberBetween($min = 1, $max = 3);
    if ($gunports >= 50) {
        $cannon_caliber++;
    }
    if ($gunports >= 200) {
        $cannon_caliber++;
    }
    if ($length >= 300) {
        $cannon_caliber++;
    }

    $hull_speed = (1.34 * sqrt($length));
    $maxSpeed = $hull_speed;
    $totalHold = $faker->numberBetween($min = 2000, $max = 20000);

    $maximumHealth = (100 * $decks) + round((0.5 * $length), 0) + (20 * $masts);

    /**
     * Classes:
     * Line ship
     * - First rate (112 cannons/400 crew)
     * - Second rate (100 cannons/350 crew)
     * - Third rate (80 cannons/300 crew)
     * - Fourth rate (74 cannons/250 crew)
     * - Fifth rate (64 cannons/250 crew)
     * - Sixth rate (54 cannons/200 crew)
     *
     * Frigate (48 cannons/200 crew)
     *
     */
    return [
        'name' => $faker->name,
        'is_beginner_ship' => false,
        'maximum_health' => $maximumHealth,
        'current_health' => $maximumHealth,
        'cannons' => $cannons,
        'gunports' => $gunports,
        'class' => $faker->name,
        'type' => $faker->name,
        'cannon_caliber' => $cannon_caliber,
        'total_hold' => $totalHold,
        'free_hold' => $totalHold,
        'constructed_at' => $faker->numberBetween($min = 1530, $max = 1640),
        'min_sailors' => $minSailors,
        'max_sailors' => $maxSailors,
        'max_speed' => $maxSpeed,
        'masts' => $masts,
        'propulsion' => $propulsion,
        'decks' => $decks,
        'length' => $length,
        'draught' => $draught,
        'beam' => $beam,
        'maneuverability' => $faker->numberBetween($min = 1, $max = 20),
    ];
});
