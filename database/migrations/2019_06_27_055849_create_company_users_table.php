<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyUsersTable extends Migration
{
    public function up()
    {
        Schema::create('company_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->uuid('auth_id');
            $table->uuid('company_id');
            $table->string('name', 64);
            $table->string('department',64);
            $table->string('image', 64);
            $table->timestamps();

            $table->foreign('auth_id')->references('id')->on('company_user_auths');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_users');
    }
}
