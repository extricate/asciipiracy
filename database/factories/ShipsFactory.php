<?php

use Faker\Generator as Faker;

$factory->define(App\Ship::class, function (Faker $faker) {


    $gunports = $faker->biasedNumberBetween($min = 0, $max = 132, $function = 'Faker\Provider\Biased::linearLow');
    // Make gunports amount an even amount
    if ($gunports % 2 == 1) {
        $gunports++;
    }

    // add cannons
    $cannons = $gunports;

    /**
     * Classes:
     * Line ship
     * - First rate (112 cannons/400 crew)
     * - Second rate (100 cannons/350 crew)
     * - Third rate (80 cannons/300 crew)
     * - Fourth rate (74 cannons/250 crew)
     * - Fifth rate (64 cannons/250 crew)
     * - Sixth rate (58 cannons/200 crew)
     *
     * Frigate (54 cannons/200 crew)
     * Full-rigged (48 cannons/200 crew)
     * Barque (42 cannons/160 crew)
     * Barquentine (40 cannons/140 crew)
     * Brig (38 cannons/140 crew)
     * Corvette (36 cannons/120 crew)
     * Snow (30 cannons/80 crew)
     * Schooner (28 cannons/60 crew)
     * Sloop (8 cannons/40 crew)
     */

    if ($cannons <= 4) {
        $class = 'Lugger';
        $type = 'gaff';
        $minSailors = $faker->numberBetween(20, 30);
        $maxSailors = $minSailors + $faker->numberBetween($min = 10, $max = 20);
        $decks = 1;
        $masts = 1;
    } elseif ($cannons <= 8) {
        $class = 'Sloop';
        $type = 'gaff';
        $minSailors = $faker->numberBetween(20, 30);
        $maxSailors = $minSailors + $faker->numberBetween($min = 10, $max = 20);
        $decks = 1;
        $masts = 1;
    } elseif ($cannons <= 28) {
        $class = 'Schooner';
        $type = 'gaff';
        $minSailors = $faker->numberBetween(30, 40);
        $maxSailors = $minSailors + $faker->numberBetween($min = 10, $max = 30);
        $decks = 1;
        $masts = 2;
    } elseif ($cannons <= 30) {
        $class = 'Snow';
        $type = 'square';
        $minSailors = $faker->numberBetween(30, 50);
        $maxSailors = $minSailors + $faker->numberBetween($min = 20, $max = 40);
        $decks = 2;
        $masts = 2;
    } elseif ($cannons <= 36) {
        $class = 'Corvette';
        $type = 'square';
        $minSailors = $faker->numberBetween(60, 80);
        $maxSailors = $minSailors + $faker->numberBetween($min = 40, $max = 50);
        $decks = 2;
        $masts = 3;
    } elseif ($cannons <= 38) {
        $class = 'Brig';
        $type = 'square';
        $minSailors = $faker->numberBetween(60, 80);
        $maxSailors = $minSailors + $faker->numberBetween($min = 50, $max = 70);
        $decks = 3;
        $masts = 2;
    } elseif ($cannons <= 40) {
        $class = 'Barquentine';
        $type = 'square';
        $minSailors = $faker->numberBetween(60, 80);
        $maxSailors = $minSailors + $faker->numberBetween($min = 40, $max = 50);
        $decks = 2;
        $masts = 3;
    } elseif ($cannons <= 42) {
        $class = 'Barque';
        $type = 'square';
        $minSailors = $faker->numberBetween(60, 80);
        $maxSailors = $minSailors + $faker->numberBetween($min = 60, $max = 90);
        $decks = 2;
        $masts = 3;
    } elseif ($cannons <= 48) {
        $class = 'Full-rigged';
        $type = 'square';
        $minSailors = $faker->numberBetween(80, 100);
        $maxSailors = $minSailors + $faker->numberBetween($min = 80, $max = 120);
        $decks = 3;
        $masts = 3;
    } elseif ($cannons <= 54) {
        $class = 'Frigate';
        $type = 'square';
        $minSailors = $faker->numberBetween(90, 100);
        $maxSailors = $minSailors + $faker->numberBetween($min = 90, $max = 120);
        $decks = 3;
        $masts = 3;
    } elseif ($cannons <= 58) {
        $class = 'First-rate Sixth Class';
        $type = 'square';
        $minSailors = $faker->numberBetween(90, 100);
        $maxSailors = $minSailors + $faker->numberBetween($min = 90, $max = 120);
        $decks = 2;
        $masts = 4;
    } elseif ($cannons <= 64) {
        $class = 'First-rate Fifth Class';
        $type = 'square';
        $minSailors = $faker->numberBetween(100, 140);
        $maxSailors = $minSailors + $faker->numberBetween($min = 120, $max = 150);
        $decks = 2;
        $masts = 4;
    } elseif ($cannons <= 74) {
        $class = 'First-rate Fourth Class';
        $type = 'square';
        $minSailors = $faker->numberBetween(100, 140);
        $maxSailors = $minSailors + $faker->numberBetween($min = 120, $max = 150);
        $decks = 3;
        $masts = 4;
    } elseif ($cannons <= 80) {
        $class = 'First-rate Third Class';
        $type = 'square';
        $minSailors = $faker->numberBetween(120, 160);
        $maxSailors = $minSailors + $faker->numberBetween($min = 140, $max = 160);
        $decks = 4;
        $masts = 4;
    } elseif ($cannons <= 100) {
        $class = 'First-rate Second Class';
        $type = 'square';
        $minSailors = $faker->numberBetween(140, 180);
        $maxSailors = $minSailors + $faker->numberBetween($min = 160, $max = 180);
        $decks = 5;
        $masts = 4;
    } else {
        $class = 'First-rate First Class';
        $type = 'square';
        $minSailors = $faker->numberBetween(160, 200);
        $maxSailors = $minSailors + $faker->numberBetween($min = 180, $max = 220);
        $decks = 5;
        $masts = 4;
    }
    $length = $decks * $faker->numberBetween($min = 40, $max = 100);
    $beam = $faker->numberBetween($min = 10, $length / 4);
    $draught = ($decks + ($beam / 100)) * $faker->numberBetween($min = 5, $max = 10);

    $hull_speed = (1.34 * sqrt($length));
    $maxSpeed = $hull_speed;
    $totalHold = $decks * ($faker->numberBetween($min = 2000, $max = 6000));

    $maximumHealth = (100 * $decks) + round((0.5 * $length), 0) + (20 * $masts);

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

    return [
        'name' => $faker->name,
        'is_beginner_ship' => false,
        'maximum_health' => $maximumHealth,
        'current_health' => $maximumHealth,
        'cannons' => $cannons,
        'gunports' => $gunports,
        'class' => $class,
        'type' => $type,
        'cannon_caliber' => $cannon_caliber,
        'total_hold' => $totalHold,
        'free_hold' => $totalHold,
        'constructed_at' => $faker->numberBetween($min = 1530, $max = 1640),
        'min_sailors' => $minSailors,
        'current_sailors' => $maxSailors,
        'max_sailors' => $maxSailors,
        'max_speed' => $maxSpeed,
        'masts' => $masts,
        'decks' => $decks,
        'length' => $length,
        'draught' => $draught,
        'beam' => $beam,
        'maneuverability' => $faker->numberBetween($min = 1, $max = 20),
    ];
});
