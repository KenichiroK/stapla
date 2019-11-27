<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('project_id')->nullable()->change();
            $table->string('partner_id')->nullable()->change();
            $table->string('superior_id')->nullable()->change();
            $table->string('accounting_id')->nullable()->change();
            $table->string('name', 64)->nullable()->change();
            $table->text('content')->nullable()->change();
            $table->dateTime('started_at')->nullable()->change();
            $table->dateTime('ended_at')->nullable()->change();
            $table->integer('status')->nullable()->change();
            $table->boolean('purchaseorder')->nullable()->change();
            $table->boolean('invoice')->nullable()->change();
            $table->biginteger('budget')->nullable()->change();
            $table->biginteger('price')->nullable()->change();
            $table->float('tax', 3, 2)->nullable()->change();
            $table->integer('cases')->nullable()->change();
            $table->string('fee_format')->nullable()->change();
        });
    }
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // 
        });
    }
}
