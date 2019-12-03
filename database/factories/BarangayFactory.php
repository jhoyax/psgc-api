<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Barangay;
use Faker\Generator as Faker;

$factory->define(Barangay::class, function (Faker $faker) {
    return [
        'city_id' => factory('App\City')->create()->id,
        'municipality_id' => 0, // factory('App\Municipality')->create()->id,
        'sub_municipality_id' => 0, // factory('App\SubMunicipality')->create()->id,
        'code' => $faker->randomNumber(),
        'name' => $faker->name(),
        'area_type' => 'rural',
        'population' => $faker->randomDigit(),
    ];
});
