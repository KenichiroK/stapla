<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Partner::class, function (Faker $faker) {
    return [
        'partner_id' => function() {
            return factory(App\Models\PartnerAuth::class)->create()->id;
        },
        'name'          => $faker->name,
        'zip_code'      => str_random(10),
        'address'       => $faker->address,
        'tel'           => $faker->phoneNumber,
        'age'           => $faker->randomNumber,
        'sex'           => $faker->numberBetween($min = 0, $max = 1),
        'picture'       => 'defaultPicture.png',
        'occupations'   => 'エンジニア',
        'academic'      => '東京大学 経済学部 経済学科 卒業',
        'careersummary' => 'エンジニア歴 3年',
        'jobcareer'     => '株式会社A エンジニア部門',
        'introduction'  => $faker->sentence,
        'feature'       => $faker->sentence,
        'created_at'    => $faker->dateTimeThisDecade,
        'updated_at'    => $faker->dateTimeThisYear,
    ];
});
