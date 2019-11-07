<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Project::class, function (Faker $faker) {
    return [
        'company_id' => App\Models\Company::first()->id,
        'name'       => $faker->randomElement(['ライティング', '記事執筆', 'マーケティング']),
        'detail'     => $faker->sentence,
        'started_at' => $faker->dateTimeThisDecade,
        'ended_at'   => $faker->dateTimeThisDecade,
        'status'     => 0,
        'budget'     => $faker->randomElement([10000, 50000, 100000]),
        'price'      => $faker->randomElement([10000, 50000, 100000]),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),
    ];
});
