<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutsourceContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outsource_contracts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('company_id');
            $table->uuid('partner_id');
            $table->string('company_name', 64);
            // NOTE: varchar191にする理由 https://qiita.com/jkr_2255/items/74fc79e764378b59355a
            $table->string('company_address', 191);
            $table->string("representive_name", 64);
            $table->string('partner_name', 64);
            $table->string('partner_address', 191);
            $table->string('court_name', 64);
            $table->date('contarcted_at');
            $table->text('comment')->nullable();
            $table->enum('status', ['uncontracted', 'progress', 'complete'])->default('uncontracted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outsource_contracts');
    }
}
