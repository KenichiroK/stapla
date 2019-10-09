<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->uuid('company_id');
            $table->string("email", 64);
            $table->string("access_key", 64);
            $table->string("password", 64)->nullable();
            $table->rememberToken();
            $table->timestamp("email_verified_at")->nullable();
            $table->string('name', 64)->nullable();
            $table->string('nickname', 64)->nullable();
            $table->string('zip_code', 64)->nullable();
            $table->string('prefecture', 64)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('street', 64)->nullable();
            $table->string('building', 64)->nullable();
            $table->string('tel')->nullable();
            $table->integer('age')->nullable();
            $table->integer('sex')->nullable();
            $table->string('picture')->nullable();
            $table->string('occupations', 64)->nullable();
            $table->text('academic')->nullable();
            $table->string('slack', 64)->nullable();
            $table->string('chatwork', 64)->nullable();
            $table->string('twitter', 64)->nullable();
            $table->string('facebook', 64)->nullable();
            $table->string('github', 64)->nullable();
            $table->string('instagram', 64)->nullable();
            $table->string('careersummary', 64)->nullable();
            $table->string('jobcareer', 64)->nullable();
            $table->text('portfolio')->nullable()->nullable();
            $table->text('introduction')->nullable();
            $table->text('possible', 64)->nullable();
            $table->string('skill', 64)->nullable();
            $table->text('feature')->nullable();
            $table->string('language', 64)->nullable();
            $table->string('qualification', 64)->nullable();
            $table->string('relatedlinks', 64)->nullable();
            $table->string('attachment', 64)->nullable();      
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
