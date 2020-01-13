<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToPurchaseOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            // 外部キーを無効化
            Schema::disableForeignKeyConstraints();

            $table->string('partner_id')->nullable()->change();
            $table->string('companyUser_id')->nullable()->change();
            $table->string('companyUser_name')->nullable()->change();
            $table->string('partner_name')->nullable()->change();
            $table->integer('task_price')->nullable()->change();

        });
    }

    public function down()
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            // 外部キーを有効化
            Schema::enableForeignKeyConstraints();
            
            $table->uuid('partner_id')->change();
            $table->uuid('companyUser_id')->change();
            $table->string('companyUser_name')->change();
            $table->string('partner_name')->change();
            $table->integer('task_price')->change();
        });
    }
}
