<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ProjectRoleRelation::class, function (Faker $faker) {
    return [
        'project_id' => App\Models\Project::all()->random()->id,
        'superior_id'   => App\Models\CompanyUser::all()->random()->id,
        'accounting_id' => App\Models\CompanyUser::all()->random()->id,
        'manager_id'    => App\Models\CompanyUser::all()->random()->id,
        'created_at' => $faker->dateTimeThisDecade,
        'updated_at' => $faker->dateTimeThisDecade,
    ];
});
