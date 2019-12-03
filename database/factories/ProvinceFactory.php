<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Province;
use Faker\Generator as Faker;

$factory->define(Province::class, function (Faker $faker) {
    return [
        'region_id' => factory('App\Region')->create()->id,
        'code' => $faker->randomNumber(),
        'name' => $faker->name(),
        'income_classification' => $faker->name(),
        'population' => $faker->randomDigit(),
    ];
});
