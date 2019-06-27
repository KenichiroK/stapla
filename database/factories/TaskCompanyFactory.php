<?php

use Faker\Generator as Faker;

$factory->define(App\Models\TaskCompany::class, function (Faker $faker) {
    return [
        'user_id'    => App\Models\CompanyUser::all()->random()->id,
        'task_id'    => App\Models\Task::all()->random()->id,
        'created_at' => $faker->dateTimeThisDecade,
        'updated_at' => $faker->dateTimeThisDecade,
    ];
});
