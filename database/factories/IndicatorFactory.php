<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Indicator;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Indicator::class, function (Faker $faker) {
    return [
        'value' => $faker->text,
        'type' => $faker->randomElement(['string', 'integer', 'guid', 'alphanumeric']),
        'length' => $faker->numberBetween(0, 15),
    ];
});

