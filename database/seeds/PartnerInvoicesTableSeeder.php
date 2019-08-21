<?php

use Illuminate\Database\Seeder;

class PartnerInvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');
        factory(App\Models\PartnerInvoice::class, 30)->create();
    }
}
