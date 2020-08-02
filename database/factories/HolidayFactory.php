<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Holiday;
use Faker\Generator as Faker;

$factory->define(Holiday::class, function (Faker $faker) {
    return [
        'start_date' => $faker->dateTimeBetween(),
        'end_date' => $faker->dateTimeInInterval('now', '+30 days')
    ];
});
