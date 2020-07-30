<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker, $args = []) {

    // get parent date or now
    $now = $args['created_at'] ?? now();

    return [
        'type' => $faker->numberBetween(1, 2),
        'created_at' => $now,
        'completed_at' => $faker->optional()->dateTimeBetween($now),
    ];
});
