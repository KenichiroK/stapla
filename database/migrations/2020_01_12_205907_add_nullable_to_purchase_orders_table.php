<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToPurchaseOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();

            $table->string('partner_id')->nullable()->change();
            $table->string('companyUser_id')->nullable()->change();
            $table->string('companyUser_name')->nullable()->change();
            $table->string('partner_name')->nullable()->change();
            $table->biginteger('task_price')->nullable()->change();

        });
    }

    public function down()
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            Schema::enableForeignKeyConstraints();
            
            $table->uuid('partner_id')->nullable(false)->change();
            $table->uuid('companyUser_id')->nullable(false)->change();
            $table->string('companyUser_name')->nullable(false)->change();
            $table->string('partner_name')->nullable(false)->change();
            $table->integer('task_price')->nullable(false)->change();
        });
    }
}