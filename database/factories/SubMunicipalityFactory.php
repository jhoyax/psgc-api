<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SubMunicipality;
use Faker\Generator as Faker;

$factory->define(SubMunicipality::class, function (Faker $faker) {
    return [
        'city_id' => factory('App\City')->create()->id,
        'code' => $faker->randomNumber(),
        'name' => $faker->name(),
        'population' => $faker->randomDigit(),
    ];
});
