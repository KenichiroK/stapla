<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Company::class, function (Faker $faker) {
    return [
        'company_name'              => $faker->company,
        'representive_name'         => $faker->name,
        'zip_code'                  => $faker->postcode,
        'tel'                       => str_replace("-", "", $faker->phoneNumber),
        'address_prefecture'        => $faker->prefecture,
        'address_city'              => $faker->city,
        'address_building'          => $faker->streetAddress,
        'expire'                    => true,
        'expire2'                   => $faker->dateTimeThisMonth,
        'approval_setting'          => true,
        'income_tax_setting'        => true,
        'remind_setting'            => true,
        'purchase_order_setting'    => true,
        'confidential_setting'      => true,
        'account_setting'           => true,
        'created_at'                => new DateTime(),
        'updated_at'                => new DateTime(),
    ];
});
