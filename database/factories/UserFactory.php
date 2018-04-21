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
        'prontuario'=> 'cv16'. str_random(5),
        'nome'=> $faker->name,
        'email' => $faker->unique()->safeEmail,
        'senha' => Hash::make('secret')
    ];
});
