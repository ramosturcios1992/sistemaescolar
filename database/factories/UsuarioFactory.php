<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Usuario;
use Faker\Generator as Faker;

$factory->define(Usuario::class, function (Faker $faker) {

    return [
        'dni' => $faker->word,
        'name' => $faker->word,
        'apellido' => $faker->word,
        'email' => $faker->word,
        'password' => $faker->word,
        'tipo' => $faker->randomDigitNotNull,
        'remember_token' => $faker->word,
        'email_verified_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
