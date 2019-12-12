<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTempemailTemptokenToComapnyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_users', function (Blueprint $table) {
            $table->string('temp_email')->nullable();
            $table->string('temp_token')->nullable();
            $table->string('temp_token_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_users', function (Blueprint $table) {
            $table->dropColumn('temp_email');
            $table->dropColumn('temp_token');
            $table->dropColumn('temp_token_time');
        });
    }
}
