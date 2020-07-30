<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker, $args = []) {

    // get parent date or now
    $now = $args['created_at'] ?? now();

    return [
        'amount' => $faker->randomNumber(2),
        'method' => $faker->numberBetween(1, 3),
        'type' => $faker->numberBetween(1, 3),
        'created_at' => $now,
    ];
});
