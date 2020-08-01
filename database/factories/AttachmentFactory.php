<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attachment;
use Faker\Generator as Faker;

$factory->define(Attachment::class, function (Faker $faker, $args = []) {

    // get parent date or now
    $now = $args['created_at'] ?? now();

    return [
        'name' => $faker->catchPhrase,
        'filename' => $faker->uuid . '.jpg',
        'created_at' => $now,
    ];
});
