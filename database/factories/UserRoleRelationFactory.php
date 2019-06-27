<?php

use Faker\Generator as Faker;

$factory->define(App\Models\UserRoleRelation::class, function (Faker $faker) {
    return [
        'user_id'    => App\Models\CompanyUser::all()->random()->id,
        'superior_id'   => App\Models\CompanyUser::all()->random()->id,
        'accounting_id' => App\Models\CompanyUser::all()->random()->id,
        'manager_id'    => App\Models\CompanyUser::all()->random()->id,
        'created_at' => $faker->dateTimeThisDecade,
        'updated_at' => $faker->dateTimeThisDecade,
    ];
});
