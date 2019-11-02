<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Task::class, function (Faker $faker) {
    $company = factory(App\Models\Company::class)->create();
    $project = factory(App\Models\Project::class)->create();
    return [
        'company_id'        => $company->id,
        'company_user_id'   => factory(App\Models\ProjectCompany::class)->create()->user_id,
        'project_id'        => $project->id,
        'partner_id'        => factory(App\Models\Partner::class)->create()->id,
        'superior_id'       => factory(App\Models\ProjectCompany::class)->create()->user_id,
        'accounting_id'     => factory(App\Models\ProjectCompany::class)->create()->user_id,
        'name'              => $faker->randomElement(['要件定義', '調査', 'コーディング']),
        'content'           => $faker->sentence,
        'started_at'        => $faker->dateTimeThisDecade,
        'ended_at'          => $faker->dateTimeThisDecade,
        'status'            => 1,
        'purchaseorder'     => true,
        'invoice'           => true,
        'budget'            => $faker->randomElement([10000, 50000, 100000]),
        'tax'               => 0.10,
        'price'             => $faker->randomElement([10000, 50000, 100000]),
        'cases'             => $faker->randomElement([1, 1, 1, 2, 3]),
        'comment'           => $faker->sentence,
        'inspection_date'   => $faker->dateTimeThisDecade,
        'fee_format'        => $faker->randomElement(['固定', '時間', '日']),
        'delivery_format'   => $faker->randomElement(['データによる送付', 'その他']),
        'payment_terms'     => $faker->randomElement(['当月末締め翌月末払い', 'その他']),
        'rating'            => $faker->numberBetween($min = 1, $max = 5),
        'rating_comment'    => $faker->sentence,
        'remarks'           => $faker->sentence,
        'created_at'        => new DateTime(),
        'updated_at'        => new DateTime(),
    ];
});
