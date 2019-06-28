<?php

use Illuminate\Database\Seeder;

class UserRoleRelationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\UserRoleRelation::class, 10)->create(); 
    }
}
