<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\PurchaseOrder::class, 1)->create(); 
    }
}
