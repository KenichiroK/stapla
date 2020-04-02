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
            $table->time('mon_opening')->nullable();
            $table->time('mon_closing')->nullable();
            $table->time('tue_opening')->nullable();
            $table->time('tue_closing')->nullable();
            $table->time('wed_opening')->nullable();
            $table->time('wed_closing')->nullable();
            $table->time('thu_opening')->nullable();
            $table->time('thu_closing')->nullable();
            $table->time('fri_opening')->nullable();
            $table->time('fri_closing')->nullable();
            $table->time('sat_opening')->nullable();
            $table->time('sat_closing')->nullable();
            $table->time('sun_opening')->nullable();
            $table->time('sun_closing')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gym_infos');
    }
}
