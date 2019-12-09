<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTaxColumnInInvoicesTable extends Migration
{
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('tax');
        });
    }

    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->boolean('tax')->default(false);
        });
    }
}
