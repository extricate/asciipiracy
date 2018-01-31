<?php

use Faker\Generator as Faker;

$factory->define(App\Settlement::class, function (Faker $faker) {

    $inhabitants = $faker->biasedNumberBetween(50, 250000, function ($x) {
        return 1 - sqrt($x);
    });
    if ($inhabitants < 100) {
        $settlementType = 1;
    } elseif ($inhabitants < 1000) {
        $settlementType = 2;
    } elseif ($inhabitants < 5000) {
        $settlementType = 3;
    } elseif ($inhabitants < 10000) {
        $settlementType = 4;
    } elseif ($inhabitants < 20000) {
        $settlementType = 5;
    } elseif ($inhabitants < 30000) {
        $settlementType = 6;
    } elseif ($inhabitants < 50000) {
        $settlementType = 7;
    } else {
        $settlementType = 8;
    }

    $general_store_name = $faker->company();
    $shipwright_name = $faker->company();
    $tavern_name = $faker->company();

    // trading goods
    $buy_modifier = 0.75;

    $tobacco_sell = $faker->numberBetween(30, 60);
    $tobacco_buy = $buy_modifier * $tobacco_sell;

    $furs_sell = $faker->numberBetween(400, 600);
    $furs_buy = $buy_modifier * $furs_sell;

    $gemstones_sell = $faker->numberBetween(1000, 1600);
    $gemstones_buy = $buy_modifier * $gemstones_sell;

    $textiles_sell = $faker->numberBetween(30, 60);
    $textiles_buy = $buy_modifier * $textiles_sell;

    $alcohol_sell = $faker->numberBetween(10, 40);
    $alcohol_buy = $buy_modifier * $alcohol_sell;

    $sugar_sell = $faker->numberBetween(160, 220);
    $sugar_buy = $buy_modifier * $sugar_sell;

    $spices_sell = $faker->numberBetween(300, 400);
    $spices_buy = $buy_modifier * $spices_sell;

    $ivory_sell = $faker->numberBetween(100, 200);
    $ivory_buy = $buy_modifier * $ivory_sell;

    $coffee_sell = $faker->numberBetween(80, 120);
    $coffee_buy = $buy_modifier * $coffee_sell;

    $mahogany_sell = $faker->numberBetween(800, 1100);
    $mahogany_buy = $buy_modifier * $mahogany_sell;



    return [
        'name' => $faker->city(),
        'type' => $settlementType,
        'general_store_name' => $general_store_name,
        'shipwright_name' => $shipwright_name,
        'tavern_name' => $tavern_name,

        // all trade goods and their generated prices
        'tobacco_buy' => $tobacco_buy,
        'tobacco_stock' => $faker->numberBetween(0, $inhabitants),
        'tobacco_sell' => $tobacco_sell,

        'furs_buy' => $furs_buy,
        'furs_stock' => $faker->numberBetween(0, $inhabitants),
        'furs_sell' => $furs_sell,

        'gemstones_buy' => $gemstones_buy,
        'gemstones_stock' => $faker->numberBetween(0, $inhabitants),
        'gemstones_sell' => $gemstones_sell,

        'textiles_buy' => $textiles_buy,
        'textiles_stock' => $faker->numberBetween(0, $inhabitants),
        'textiles_sell' => $textiles_sell,

        'alcohol_buy' => $alcohol_buy,
        'alcohol_stock' => $faker->numberBetween(0, $inhabitants),
        'alcohol_sell' => $alcohol_sell,

        'sugar_buy' => $sugar_buy,
        'sugar_stock' => $faker->numberBetween(0, $inhabitants),
        'sugar_sell' => $sugar_sell,

        'spices_buy' => $spices_buy,
        'spices_stock' => $faker->numberBetween(0, $inhabitants),
        'spices_sell' => $spices_sell,

        'ivory_buy' => $ivory_buy,
        'ivory_stock' => $faker->numberBetween(0, $inhabitants),
        'ivory_sell' => $ivory_sell,

        'coffee_buy' => $coffee_buy,
        'coffee_stock' => $faker->numberBetween(0, $inhabitants),
        'coffee_sell' => $coffee_sell,

        'mahogany_buy' => $mahogany_buy,
        'mahogany_stock' => $faker->numberBetween(0, $inhabitants),
        'mahogany_sell' => $mahogany_sell,
    ];
});
