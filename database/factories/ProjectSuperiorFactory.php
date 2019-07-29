<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ProjectSuperior::class, function (Faker $faker) {
    return [
        'project_id' => App\Models\Project::all()->random()->id,
        'user_id'    => App\Models\CompanyUser::all()->random()->id,
    ];
});
