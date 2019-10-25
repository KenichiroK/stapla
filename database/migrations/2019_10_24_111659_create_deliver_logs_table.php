<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliverLogsTable extends Migration
{
    public function up()
    {
        Schema::create('deliver_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('task_id');
            $table->uuid('partner_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deliver_logs');
    }
}
