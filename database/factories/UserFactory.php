<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'nomUser' => $faker->lastName,
        'prenomUser' => $faker->firstName,
        'mailUser' => $faker->unique()->safeEmail,
        'mdpUser' => bcrypt($faker->password), // secret
        'telUser' => $faker->phoneNumber,
        'idRole' => $faker->numberBetween($min = 2, $max = 3),
        'remember_token' => str_random(10)
    ];
});
