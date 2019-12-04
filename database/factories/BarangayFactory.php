<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Barangay;
use Faker\Generator as Faker;

$factory->define(Barangay::class, function (Faker $faker) {
    return factory('App\Barangay')->create([
        'city_type' => 'App\City',
        'city_id' => factory('App\City')->create()->id,
        'code' => $faker->randomNumber(),
        'name' => $faker->name(),
        'area_type' => 'rural',
        'population' => $faker->randomDigit(),
    ]);
});
