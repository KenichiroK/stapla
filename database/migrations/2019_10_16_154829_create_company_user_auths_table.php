<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyUserAuthsTable extends Migration
{
    public function up()
    {
        Schema::create('company_user_auths', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->string('email', 64);
            $table->string('company_id', 64);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('company_user_auths');
    }
}
