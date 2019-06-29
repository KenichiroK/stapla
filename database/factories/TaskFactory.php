<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Task::class, function (Faker $faker) {
    $project = App\Models\Project::all()->random();
    return [
        'company_id'        => $project->company_id,
        'project_id'        => $project->id,
        'name'              => $faker->randomElement(['要件定義', '調査', 'コーディング']),
        'content'           => $faker->sentence,
        'started_at'        => $faker->dateTimeThisDecade,
        'ended_at'          => $faker->dateTimeThisDecade,
        'status'            => $faker->numberBetween($min = 0, $max = 10),
        'purchaseorder'     => true,
        'invoice'           => true,
        'budget'            => $faker->randomElement([10000, 50000, 100000]),
        'price'             => $faker->randomElement([10000, 50000, 100000]),
        'comment'           => $faker->sentence,
        'inspection_date'   => $faker->dateTimeThisDecade,
        'fee_format'        => $faker->randomElement(['固定', '時間', '日']),
        'delivery_format'   => $faker->randomElement(['データによる送付', 'その他']),
        'payment_terms'     => $faker->randomElement(['当月末締め翌月末払い', 'その他']),
        'rating'            => $faker->numberBetween($min = 1, $max = 5),
        'created_at'        => $faker->dateTimeThisDecade,
        'updated_at'        => $faker->dateTimeThisYear,
    ];
});
