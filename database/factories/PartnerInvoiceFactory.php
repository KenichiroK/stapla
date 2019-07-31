<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PartnerInvoice::class, function (Faker $faker) {
    return [
        'partner_id' => function() {
            return factory(App\Models\Partner::class)->create()->id;
        },
        'financial_institution' => 'dummy銀行',
        'branch' => '東京支店',
        'deposit_type' => '普通',
        'account_number' => '1234567',
        'account_holder' => 'ヤマダ タロウ',
        'mark_image' => 'public/images/default/dummy_user.jpeg',
    ];
});
