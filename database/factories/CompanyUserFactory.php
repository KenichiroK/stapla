<?php

use Faker\Generator as Faker;

$factory->define(App\Models\CompanyUser::class, function (Faker $faker) {
    return [
        'email'             => $faker->unique()->safeEmail,
        'password'          => Hash::make('password'), // secret
        'remember_token'    => str_random(10),
        'email_verified_at' => $faker->dateTimeThisDecade,
        'company_id'        => App\Models\Company::all()->random()->id,
        'name'              => $faker->name,
        'department'        => $faker->randomElement(['総務部', '人事部', '営業部', '海外事業部', 'IT事業部']),
        'occupation'        => $faker->randomElement(['営業', '企画', 'エンジニア', 'アシスタント', 'ディレクター']),
        'self_introduction' => $faker->sentence,
        'picture'           => 'https://dev-impro.s3-ap-northeast-1.amazonaws.com/test/docker.jpeg',
        'created_at'        => new DateTime(),
        'updated_at'        => new DateTime(),
    ];
});
