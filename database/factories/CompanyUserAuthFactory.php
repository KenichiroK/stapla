<?php

use Faker\Generator as Faker;

$factory->define(App\Models\CompanyUserAuth::class, function (Faker $faker) {
    return [
        'email'             => $faker->unique()->safeEmail,
        'password'          => Hash::make('password'), // secret
        'remember_token'    => str_random(10),
        'email_verified_at'  => $faker->dateTimeThisDecade,
        'created_at'        => $faker->dateTimeThisDecade,
        'updated_at'        => $faker->dateTimeThisYear,
    ];
});
