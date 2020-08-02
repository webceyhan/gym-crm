<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attachment;
use Faker\Generator as Faker;

$factory->define(Attachment::class, function (Faker $faker) {
    return [
        'name' => $faker->catchPhrase,
        'filename' => $faker->uuid . '.jpg',
    ];
});
