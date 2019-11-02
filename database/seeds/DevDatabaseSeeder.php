<?php

use Illuminate\Database\Seeder;

class DevDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
          CompaniesTableSeeder::class,
          CompanyUsersTableSeeder::class,
          PartnersTableSeeder::class,
        ]);
    }
}
