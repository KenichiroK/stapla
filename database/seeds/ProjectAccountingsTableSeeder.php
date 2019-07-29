<?php

use Illuminate\Database\Seeder;

class ProjectAccountingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\ProjectAccounting::class, 100)->create(); 
    }
}
