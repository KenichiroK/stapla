<?php

use Illuminate\Database\Seeder;

class ProjectCompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\ProjectCompany::class, 10)->create(); 
    }
}
