<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Region;
use Faker\Generator as Faker;

$factory->define(Region::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(),
        'name' => $faker->name(),
        'population' => $faker->randomDigit(),
    ];
});
