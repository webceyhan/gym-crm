<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Plan;
use Faker\Generator as Faker;

$factory->define(Plan::class, function (Faker $faker, $args = []) {

    // get parent date or now
    $now = $args['created_at'] ?? now();

    return [
        'name' => $faker->catchPhrase(),
        'description' => $faker->realText(),
        'type' => $faker->numberBetween(1, 5),
        'duration' => $faker->numberBetween(0, 24),
        'price' => $faker->randomNumber(2),
        'installment' => $faker->boolean(),
        'created_at' => $now,
    ];
});
