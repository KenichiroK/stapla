<?php
use Faker\Generator as Faker;
$factory->define(App\Models\PurchaseOrder::class, function (Faker $faker) {
    $taskPartner = App\Models\TaskPartner::all()->random();
    $task = App\Models\Task::find($taskPartner->task_id);
    
    $project = App\Models\Project::find($task->project_id);
    $company = App\Models\Company::find($project->company_id);

    $companyUser = App\Models\CompanyUser::where('company_id',$company->id)->get()->random();

    $partner = App\Models\Partner::find($taskPartner->partner_id);
    return [
        'company_id'         => $task->company_id,
        'partner_id'         => $taskPartner->user_id,
        'task_id'            => $task->id,
        'status'             => $faker->numberBetween($min = 0, $max = 3),
        'ordered_at'         => $task->created_at,
        'company_name'       => $faker->company,
        'company_tel'        => $faker->phoneNumber,
        'company_zip_code'   => $faker->postcode,
        'company_prefecture' => $company->address_prefecture,
        'company_city'       => $faker->city,
        'company_building'   => $faker->streetAddress,
        'companyUser_name'   => $companyUser->name,
        'partner_name'       => $faker->name,
        'task_name'          => $task->name,
        'task_ended_at'      => $task->ended_at,
        'task_price'         => $task->price,
        'task_tax'           => $task->tax,
        'created_at'         => $task->created_at,
        'updated_at'         => $task->updated_at,
    ];
});