<?php

use Illuminate\Database\Seeder;

class TaskRoleRelationsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\TaskRoleRelation::class, 10)->create();
    }
}
