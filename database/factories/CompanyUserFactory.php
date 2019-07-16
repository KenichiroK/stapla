<?php

use Faker\Generator as Faker;

$factory->define(App\Models\CompanyUser::class, function (Faker $faker) {
    return [
        'auth_id' => function() {
            return factory(App\Models\CompanyUserAuth::class)->create()->id;
        },
        // 'auth_id'    => App\Models\CompanyUserAuth::all()->random()->id,
        'company_id' => App\Models\Company::all()->random()->id,
        'name'       => $faker->name,
        'department' => $faker->randomElement(['総務部', '人事部', '営業部', '海外事業部', 'IT事業部']),
        'occupation' => $faker->randomElement(['営業', '企画', 'エンジニア', 'アシスタント', 'ディレクター']),
        'picture'      => 'defaultImage.png',
        'created_at' => $faker->dateTimeThisDecade,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
