<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
          CompaniesTableSeeder::class,
          CompanyUserAuthsTableSeeder::class,
          CompanyUsersTableSeeder::class,
          ProjectsTableSeeder::class,
          TasksTableSeeder::class,
          TaskRoleRelationsTableSeeder::class,
          PartnersTableSeeder::class,
          UserRoleRelationsTableSeeder::class,
          ProjectRoleRelationsTableSeeder::class,
          ProjectCompaniesTableSeeder::class,
          TaskCompaniesTableSeeder::class,
          ProjectPartnersTableSeeder::class,
          TaskPartnersTableSeeder::class,
          TaskRoleRelationsTableSeeder::class,
        ]);
        
    }
}
