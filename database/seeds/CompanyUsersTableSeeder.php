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
        App\Models\CompanyUser::create([
            'auth_id'    => CompanyUserAuth::where('email', 'admin@admin.com')->get()->first()->id,
            'company_id' => Company::all()->random()->id,
            'name'       => 'テストユーザー',
            'department' => 'sample sample',
            'occupation' => 'sample sample',
            'picture'      => '',
            'created_at' => '2019-02-10 00:41:14',
            'updated_at' => '2019-02-10 00:41:14',
        ]);
        factory(App\Models\CompanyUser::class, 10)->create();
    }
}
