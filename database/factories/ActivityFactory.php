<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    return [
        'type' => $faker->numberBetween(1, 2),
        'completed_at' => $faker->optional()->passthrough(now()),
    ];
});
