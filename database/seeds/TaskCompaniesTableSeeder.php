<?php

use Illuminate\Database\Seeder;

class TaskCompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\TaskCompany::class, 10)->create(); 
    }
}
