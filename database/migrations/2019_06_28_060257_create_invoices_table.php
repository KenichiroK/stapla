<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('company_id');
            $table->uuid('companyUser_id');
            $table->uuid('partner_id');
            $table->string('project_name');
            $table->date('requested_at');
            $table->date('deadline_at');
            $table->boolean('tax');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('partner_id')->references('id')->on('partners');
            $table->foreign('companyUser_id')->references('id')->on('company_users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
