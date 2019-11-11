<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('company_id')->nullable()->change();
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
            $table->dropColumn('company_id')->nullable();
            $table->dropColumn('project_id')->nullable();
            $table->dropColumn('partner_id')->nullable();
            $table->dropColumn('superior_id')->nullable();
            $table->dropColumn('accounting_id')->nullable();
            $table->dropColumn('name', 64)->nullable();
            $table->dropColumn('content')->nullable();
            $table->dropColumn('started_at')->nullable();
            $table->dropColumn('ended_at')->nullable();
            $table->dropColumn('status')->nullable();
            $table->dropColumn('purchaseorder')->nullable();
            $table->dropColumn('invoice')->nullable();
            $table->dropColumn('budget')->nullable();
            $table->dropColumn('price')->nullable();
            $table->dropColumn('tax', 3, 2)->nullable();
            $table->dropColumn('cases')->nullable();
            $table->dropColumn('fee_format')->nullable();
        });
    }
}