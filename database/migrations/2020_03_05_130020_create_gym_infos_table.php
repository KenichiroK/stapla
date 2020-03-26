<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymInfosTable extends Migration
{
    public function up()
    {
        Schema::create('gym_infos', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('owner_id');
            $table->string('name')->nullable();
            $table->string('prefecture', 10)->nullable();
            $table->string('city', 20)->nullable();
            $table->string('street', 64)->nullable();
            $table->string('building', 64)->nullable();
            $table->string('mobile_phone_number', 11)->nullable();
            $table->string('landline_phone_number', 11)->nullable();
            $table->string('closest_station', 64)->nullable();
            $table->integer('maximum_capacity')->nullable();
            $table->integer('size')->nullable();
            $table->dateTime('mon_opening')->nullable();
            $table->dateTime('mon_closing')->nullable();
            $table->dateTime('tue_opening')->nullable();
            $table->dateTime('tue_closing')->nullable();
            $table->dateTime('wed_opening')->nullable();
            $table->dateTime('wed_closing')->nullable();
            $table->dateTime('thu_opening')->nullable();
            $table->dateTime('thu_closing')->nullable();
            $table->dateTime('fri_opening')->nullable();
            $table->dateTime('fri_closing')->nullable();
            $table->dateTime('sat_opening')->nullable();
            $table->dateTime('sat_closing')->nullable();
            $table->dateTime('sun_opening')->nullable();
            $table->dateTime('sun_closing')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gym_infos');
    }
}
