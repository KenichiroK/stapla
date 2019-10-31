<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaskIdToCompanyUsersTable extends Migration
{
    public function up()
    {
        Schema::table('company_users', function (Blueprint $table) {
            $table->uuid('task_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('company_users', function (Blueprint $table) {
            $table->dropColumn('task_id');
        });
    }
}
