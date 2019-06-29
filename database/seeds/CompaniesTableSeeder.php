<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\Company::class, 2)->create(); 
    }
}
