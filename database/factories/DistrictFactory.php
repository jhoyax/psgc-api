<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\District;
use Faker\Generator as Faker;

$factory->define(District::class, function (Faker $faker) {
    return [
        'region_id' => factory('App\Region')->create()->id,
        'code' => $faker->randomNumber(),
        'name' => $faker->name(),
        'population' => $faker->randomDigit(),
    ];
});
