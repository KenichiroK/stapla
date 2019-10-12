<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Partner::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'company_id'        => App\Models\Company::all()->random()->id,
        'partner_id' => function() {
            return factory(App\Models\PartnerAuth::class)->create()->id;
        },
        'name'          => $name,
        'nickname'      => $name,
        'zip_code'      => $faker->postcode,
        'prefecture'    => $faker->prefecture,
        'city'          => $faker->city,
        'street'        => $faker->streetAddress,
        'building'      => $faker->buildingNumber,
        'tel'           => $faker->phoneNumber,
        'age'           => $faker->randomNumber,
        'sex'           => $faker->numberBetween($min = 0, $max = 1),
        'picture'       => 'https://dev-impro.s3-ap-northeast-1.amazonaws.com/test/docker.jpeg',
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
