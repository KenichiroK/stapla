<?php

use Illuminate\Database\Seeder;

class NdasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\Nda::class, 20)->create(); 
    }
}
