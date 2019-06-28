<?php

use Illuminate\Database\Seeder;

class TaskCompaniesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\TaskCompany::class, 10)->create(); 
    }
}
