<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {
    return [
        'start_date' => $faker->date(),
        'end_date' => $faker->date(),
        'balance' => $faker->randomNumber(2),
    ];
});
