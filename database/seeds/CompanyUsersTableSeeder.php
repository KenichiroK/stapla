<?php

use Illuminate\Database\Seeder;
use App\Models\CompanyUserAuth;
use App\Models\Company;

class CompanyUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\CompanyUser::class, 5)->create();
    }
}
