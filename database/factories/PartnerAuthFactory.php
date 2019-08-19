<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PartnerAuth::class, function (Faker $faker) {
    return [
        'email'             => $faker->safeEmail,
        'password'          => Hash::make('password'),
        'remember_token'    => str_random(10),
        'email_verified_at' => $faker->dateTimeThisDecade,
        'created_at'        => $faker->dateTimeThisDecade,
        'updated_at'        => $faker->dateTimeThisYear,
    ];
});
