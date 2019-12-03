<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'province_id' => factory('App\Province')->create()->id,
        'district_id' => 0, // factory('App\District')->create()->id,
        'code' => $faker->randomNumber(),
        'name' => $faker->name(),
        'city_class' => $faker->name(),
        'income_classification' => $faker->name(),
        'population' => $faker->randomDigit(),
    ];
});
