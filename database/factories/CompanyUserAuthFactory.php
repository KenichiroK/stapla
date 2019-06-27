<?php

use Faker\Generator as Faker;

$factory->define(App\Models\CompanyUserAuth::class, function (Faker $faker) {
    return [
        // 'company_user_role' => $faker->numberBetween($min = 0, $max = 4),
        'email'             => $faker->unique()->safeEmail,
        'password'          => Hash::make('password'), // secret
        'remember_token'    => str_random(10),
        'email_verfied_at'  => $faker->dateTimeThisDecade,
        'created_at'        => $faker->dateTimeThisDecade,
        'updated_at'        => $faker->dateTimeThisYear,
    ];
});
