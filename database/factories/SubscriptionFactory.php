<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker, $args = []) {

    // get parent date or now
    $now = $args['created_at'] ?? now();

    return [
        'start_date' => $now,
        'end_date' => $faker->dateTimeBetween($now),
        'balance' => $faker->randomNumber(2),
        'created_at' => $now,
        'cancelled_at' => $faker->optional(.2)->dateTimeBetween($now),
    ];
});
