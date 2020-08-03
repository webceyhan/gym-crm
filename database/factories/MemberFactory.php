<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'name' => "$faker->firstName $faker->lastName",
        'ssn' => $faker->isbn13,
        'birth_date' => $faker->date,
        'birth_place' => $faker->optional(.7)->city,
        'phone' => $faker->optional(.8)->e164PhoneNumber,
        'email' => $faker->optional(.2)->email,
        'address' => $faker->optional(.7)->address,
        'photo' => $faker->optional(.8)->passthrough("{$faker->uuid}.jpg"),
        'notes' => $faker->optional(.2)->realText,
        'status' => $faker->numberBetween(1, 3),
    ];
});
