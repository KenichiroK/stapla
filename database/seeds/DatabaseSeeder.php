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
          PartnerInvoicesTableSeeder::class,
          ProjectsTableSeeder::class,
          ProjectCompaniesTableSeeder::class,
          ProjectPartnersTableSeeder::class,
          ProjectAccountingsTableSeeder::class,
          ProjectSuperiorsTableSeeder::class,
          TasksTableSeeder::class,
          TaskRoleRelationsTableSeeder::class,
          UserRoleRelationsTableSeeder::class,
          ProjectRoleRelationsTableSeeder::class,
          TaskCompaniesTableSeeder::class,
          TaskPartnersTableSeeder::class,
          ContractsTableSeeder::class,
          NdasTableSeeder::class,
          PurchaseOrdersTableSeeder::class,
          InvoicesTableSeeder::class,
        ]);
        
    }
}
