<?php

use Faker\Generator as Faker;

$factory->define(App\Grupo_Usuarios::class, function (Faker $faker) {
    return [
        'nomeGrupo'=> $faker->jobTitle
    ];
});
