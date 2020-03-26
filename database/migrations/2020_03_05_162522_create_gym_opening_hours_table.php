<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymOpeningHoursTable extends Migration
{
    public function up()
    {
        Schema::create('gym_closing_hours', function (Blueprint $table) {
            $table->uuid('id');
            $table->dateTime('opening_hour')->nullabel();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gym_opening_hours');
    }
}
