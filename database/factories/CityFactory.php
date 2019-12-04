<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return factory('App\City')->create([
        'geographic_type' => 'App\Province',
        'geographic_id' => factory('App\Province')->create()->id,
        'code' => $faker->randomNumber(),
        'name' => $faker->name(),
        'city_class' => $faker->name(),
        'income_class' => $faker->name(),
        'population' => $faker->randomDigit(),
    ]);
});
