<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->uuid('company_id');
            $table->uuid('companyUser_id');
            $table->uuid('partner_id');
            $table->uuid('task_id');
            $table->integer('status');
            $table->dateTime('ordered_at')->nullable();
            $table->string('company_name');
            $table->string('company_tel');
            $table->string('company_zip_code');
            $table->string('company_prefecture');
            $table->string('company_city');
            $table->string('company_building');
            $table->string('companyUser_name');
            $table->string('partner_name');
            $table->string('task_name');
            $table->string('task_delivery_format')->nullable();
            $table->dateTime('task_ended_at');
            $table->integer('task_price');
            $table->float('task_tax', 3, 2);

            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('partner_id')->references('id')->on('partners');
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
}
