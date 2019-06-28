<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->uuid('company_id');
            $table->uuid('project_id');
            $table->string('name', 64);
            $table->text('content');
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->integer('status');
            $table->boolean('purchaseorder');
            $table->boolean('invoice');
            $table->integer('budget');
            $table->integer('price');
            $table->text('comment');
            $table->dateTime('inspection_date');
            $table->string('fee_format');
            $table->string('delivery_format');
            $table->string('payment_terms');
            $table->integer('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
