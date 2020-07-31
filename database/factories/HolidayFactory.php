<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Holiday;
use Faker\Generator as Faker;

$factory->define(Holiday::class, function (Faker $faker, $args = []) {

    // get parent date or now
    $now = $args['created_at'] ?? now();

    $startDate = $faker->dateTimeBetween($now, '3 months');
    $endDate = $faker->dateTimeBetween($startDate, '3 months');

    return [
        'start_date' => $startDate,
        'end_date' => $endDate,
        'created_at' => $now,
    ];
});
