<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PurchaseOrder::class, function (Faker $faker) {
    $task         = factory(App\Models\Task::class)->create();
    $company      = App\Models\Company::findOrFail($task->company_id);
    $company_user = App\Models\CompanyUser::findOrFail($task->company_user_id);
    $partner      = App\Models\Partner::findOrFail($task->partner_id);

    return [
        'company_id'           => $task->company_id,
        'companyUser_id'       => $task->company_user_id,
        'partner_id'           => $task->partner_id,
        'task_id'              => $task->id,
        'status'               => config('consts.order.DRAFT'),
        'ordered_at'           => $task->created_at,
        'company_name'         => $company->company_name,
        'company_tel'          => $company->tel,
        'company_zip_code'     => $company->zip_code,
        'company_prefecture'   => $company->address_prefecture,
        'company_city'         => $company->address_city,
        'company_building'     => $company->address_building,
        'companyUser_name'     => $company_user->name,
        'partner_name'         => $partner->name,
        'task_name'            => $task->name,
        'task_delivery_format' => $task->delivery_format,
        'task_ended_at'        => $task->ended_at,
        'task_price'           => $task->price,
        'task_tax'             => $task->tax,
        'created_at'           => new DateTime(),
        'updated_at'           => new DateTime(),
    ];
});
