<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Invoice::class, function (Faker $faker) {
    $taskPartner = App\Models\TaskPartner::all()->random();
    $task = App\Models\Task::find($taskPartner->task_id);
    return [
        'company_id'     => $task->company_id,
        'companyUser_id' => App\Models\CompanyUser::where('company_id', $task->company_id)->get()->random(),
        'task_id'     => $task->id,
        'partner_id'     => $taskPartner->user_id,
        'project_name'   => App\Models\Project::find($task->project_id),
        'requested_at'   => $task->created_at,
        'deadline_at'    => $faker->dateTimeThisYear,
        'tax'            => $faker->boolean,
        'status'         => $faker->numberBetween($min = 0, $max = 3),
        'created_at'     => $task->created_at,
        'updated_at'     => $task->updated_at,
    ];
});
