<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Plan;
use Faker\Generator as Faker;

$factory->define(Plan::class, function (Faker $faker) {
    return [
        'name' => $faker->catchPhrase(),
        'description' => $faker->realText(),
        'duration' => $faker->numberBetween(0, 24),
        'price' => $faker->randomNumber(2),
        'monthly_fee' => $faker->randomNumber(2),
        'extra_fee' => $faker->randomNumber(2),
    ];
});
