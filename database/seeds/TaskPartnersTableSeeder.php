<?php

use Illuminate\Database\Seeder;

class TaskPartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\TaskPartner::class, 10)->create(); 
    }
}
