<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {

    return [
        'start_date' => now(),
        'end_date' => now()->addMonths(rand(1, 24)),
        'balance' => $faker->randomNumber(2),
        'cancelled_at' => $faker->optional(.2)->dateTimeBetween(),
    ];
});
