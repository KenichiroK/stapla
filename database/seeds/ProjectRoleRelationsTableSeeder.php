<?php

use Illuminate\Database\Seeder;

class ProjectRoleRelationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\ProjectRoleRelation::class, 10)->create(); 
    }
}
