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
            $table->uuid('partner_id');
            $table->uuid('task_id');
            $table->integer('status');
            $table->dateTime('ordered_at');
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
