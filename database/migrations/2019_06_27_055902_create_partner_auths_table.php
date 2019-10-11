<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerAuthsTable extends Migration
{
    public function up()
    {
        Schema::create('partner_auths', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->uuid('company_id')->nullable();
            $table->string("email", 64);
            // $table->string("password", 64);
            $table->rememberToken();
            $table->timestamp("email_verified_at")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('partner_auths');
    }
}
