<?php

use Illuminate\Database\Seeder;

class ProjectPartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\ProjectPartner::class, 100)->create(); 
    }
}
