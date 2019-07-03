<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PurchaseOrder::class, function (Faker $faker) {
    $task = App\Models\Task::all()->random();
    return [
        'company_id' => $task->company_id,
        'task_id'    => $task->id,
        'status'     => $faker->numberBetween($min = 1, $max = 5),
        'ordered_at' => $task->created_at,
        'created_at' => $task->created_at,
        'updated_at' => $task->updated_at,
    ];
});
