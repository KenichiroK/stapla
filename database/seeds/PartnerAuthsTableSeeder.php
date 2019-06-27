<?php

use Illuminate\Database\Seeder;

class PartnerAuthsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\PartnerAuth::class, 10)->create(); 
    }
}
