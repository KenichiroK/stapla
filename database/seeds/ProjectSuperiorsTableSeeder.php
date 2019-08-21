<?php

use Illuminate\Database\Seeder;

class ProjectSuperiorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\ProjectSuperior::class, 100)->create(); 
    }
}
