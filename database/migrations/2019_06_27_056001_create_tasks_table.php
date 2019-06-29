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
            $table->string('task_name', 64);
            $table->text('task_content');
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->integer('status');
            $table->boolean('purchaseorder');
            $table->boolean('invoice');
            $table->integer('budget');
            $table->integer('price');
            $table->text('comment')->nullable();
            $table->dateTime('inspection_date')->nullable();
            $table->string('fee_format');
            $table->string('delivery_format')->nullable();
            $table->string('payment_terms')->nullable();
            $table->integer('rating')->nullable();
            $table->text('rating_comment')->nullable();
            $table->text('remarks')->nullable();
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
