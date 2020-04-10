<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('gym_reservations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('gym_id');
            $table->date('reservation_date');
            $table->time('reservation_start_time')->nullable();
            $table->time('reservation_end_time')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gym_reservations');
    }
}
