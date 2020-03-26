<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnersTable extends Migration
{
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            // 登録時に必要
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');

            // 個人情報登録
            $table->string('name')->nullable();
            $table->date('birthday')->nullable();
            $table->string('prefecture', 10)->nullable();
            $table->string('city', 20)->nullable();
            $table->string('street', 64)->nullable();
            $table->string('building', 64)->nullable();
            $table->string('mobile_phone_number', 11)->nullable();
            $table->string('landline_phone_number', 11)->nullable();
            $table->timestamps();

            // ?
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owners');
    }
}
