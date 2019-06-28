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
            $table->uuid('partner_id');
            $table->string('name', 64);
            $table->string('zip_code', 64);
            $table->string('address', 64);
            $table->string('tel');
            $table->integer('age');
            $table->integer('sex');
            $table->string('picture', 64);
            $table->string('occupations', 64);
            $table->text('academic');
            $table->string('slack', 64)->nullable();
            $table->string('chatwork', 64)->nullable();
            $table->string('twitter', 64)->nullable();
            $table->string('faceboo', 64)->nullable();
            $table->string('careersummary', 64);
            $table->string('jobcareer', 64);
            $table->text('portfolio')->nullable();
            $table->text('introduction');
            $table->text('possible', 64)->nullable();
            $table->string('skill', 64)->nullable();
            $table->text('feature');
            $table->string('language', 64)->nullable();
            $table->string('qualification', 64)->nullable();
            $table->string('relatedlinks', 64)->nullable();
            $table->string('attachment', 64)->nullable();      
            $table->timestamps();

            $table->foreign('partner_id')->references('id')->on('partner_auths');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
