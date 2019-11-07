<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ProjectCompany::class, function (Faker $faker) {
    return [
        'user_id'    => factory(App\Models\CompanyUser::class)->create()->id,
        'project_id' => App\Models\Project::first()->id,
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ];
});
