<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
          CompaniesTableSeeder::class,
          // CompanyUserAuthsTableSeeder::class,
          CompanyUsersTableSeeder::class,
          // PartnerAuthsTableSeeder::class,
          PartnersTableSeeder::class,
          // ProjectsTableSeeder::class,
          // ProjectCompaniesTableSeeder::class,
          // ProjectPartnersTableSeeder::class,
          // ProjectAccountingsTableSeeder::class,
          // ProjectSuperiorsTableSeeder::class,
          // TasksTableSeeder::class,
          // TaskRoleRelationsTableSeeder::class,
          // UserRoleRelationsTableSeeder::class,
          // ProjectRoleRelationsTableSeeder::class,
          // PurchaseOrdersTableSeeder::class,
          // InvoicesTableSeeder::class,
        ]);
        
    }
}
