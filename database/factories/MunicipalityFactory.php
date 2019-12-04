<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Municipality;
use Faker\Generator as Faker;

$factory->define(Municipality::class, function (Faker $faker) {
    return factory('App\Municipality')->create([
        'geographic_type' => 'App\Province',
        'geographic_id' => factory('App\Province')->create()->id,
        'code' => $faker->randomNumber(),
        'name' => $faker->name(),
        'income_classification' => $faker->name(),
        'population' => $faker->randomDigit(),
    ]);
});
