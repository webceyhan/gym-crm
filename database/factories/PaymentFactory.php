<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomNumber(2),
        'method' => $faker->numberBetween(1, 3),
        'type' => $faker->numberBetween(1, 3),
    ];
});
