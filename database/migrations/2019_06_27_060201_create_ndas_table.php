<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNdasTable extends Migration
{
    public function up()
    {
        Schema::create('ndas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('company_id');
            $table->uuid('task_id');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ndas');
    }
}
