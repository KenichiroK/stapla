<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ProjectCompany::class, function (Faker $faker) {
    return [
        'user_id'    => App\Models\CompanyUser::all()->random()->id,
        'project_id' => App\Models\Project::all()->random()->id,
        'created_at' => $faker->dateTimeThisDecade,
        'updated_at' => $faker->dateTimeThisDecade,
    ];
});
