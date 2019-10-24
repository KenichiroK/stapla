<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyUsersTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('company_users');
        Schema::create('company_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->string('email', 64)->unique();
            $table->string('password', 64);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->uuid('company_id')->nullable();
            $table->string('name', 64)->nullable();
            $table->string('department',64)->nullable();
            $table->string('occupation',64)->nullable();
            $table->text('self_introduction')->nullable();
            $table->string('picture')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_users');
    }
}
