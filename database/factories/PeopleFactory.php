<?php

use Faker\Generator as Faker;

$factory->define(App\Person::class, function (Faker $faker) {
    $level = $faker->numberBetween($min = 1, $max = 10);

    // stats
    $strength = $faker->numberBetween($min = 15, $max = $level * 5);
    $dexterity = $faker->numberBetween($min = 15, $max = $level * 5);
    $intelligence = $faker->numberBetween($min = 15, $max = $level * 5);
    $stamina = $faker->numberBetween($min = 15, $max = $level * 5);
    $charisma = $faker->numberBetween($min = 15, $max = $level * 5);

    return [
        'name' => $faker->firstName,
        'level' => $level,

        // attributes
        'strength' => $strength,
        'dexterity' => $dexterity,
        'intelligence' => $intelligence,
        'stamina' => $stamina,
        'charisma' => $charisma,

        'renown' => $faker->numberBetween($min = 0, $max = 5000),
        'nationality' => $faker->numberBetween($min = 0, $max = 5),
    ];
});
