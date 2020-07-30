<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker, $args = []) {

    // get parent date or now
    $now = $args['created_at'] ?? now();

    return [
        'name' => "$faker->firstName $faker->lastName",
        'nin' => $faker->isbn13,
        'birth_date' => $faker->date,
        'birth_place' => $faker->optional()->city,
        'phone' => $faker->optional()->e164PhoneNumber,
        'email' => $faker->optional()->email,
        'address' => $faker->optional()->address,
        'photo' => $faker->optional()->passthrough("{$faker->uuid}.jpg"),
        'notes' => $faker->optional(0.2)->realText,
        'status' => $faker->numberBetween(1, 3),
        'created_at' => $now,
    ];
});
