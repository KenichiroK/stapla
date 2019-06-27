<?php

use Illuminate\Database\Seeder;

class CompanyUserAuthsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        App\Models\CompanyUserAuth::create([
            'email'             => 'admin@admin.com',
            'password'          => Hash::make('password'),
            'remember_token'    => str_random(10),
            'created_at'        => '2019-02-10 00:41:14',
            'updated_at'        => '2019-02-10 00:41:14',
        ]);
        // factory(App\Models\CompanyUserAuth::class, 10)->create();
    }
}
