<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->string("company_name", 64);
            $table->string("representive_name", 64);
            $table->string("zip_code", 64);
            $table->string("address_prefecture", 64);
            $table->string("address_city", 64);
            $table->string("address_building", 64)->nullable();
            $table->string("tel");
            $table->boolean("expire");
            $table->string("expire2");
            $table->boolean("approval_setting");
            $table->boolean("income_tax_setting");
            $table->boolean("remind_setting");
            $table->boolean("purchase_order_setting");
            $table->boolean("confidential_setting");
            $table->boolean("account_setting");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
