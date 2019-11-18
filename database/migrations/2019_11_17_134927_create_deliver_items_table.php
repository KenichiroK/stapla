<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliverItemsTable extends Migration
{
    public function up()
    {
        Schema::create('deliver_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('deliver_id');
            $table->string('file');
            $table->timestamps();

            $table->foreign('deliver_id')->references('id')->on('delivers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('deliver_items');
    }
}
