<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_partners', function (Blueprint $table) {
            Schema::create('task_partner_pics', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->uuid('id')->primary();
                $table->uuid('user_id');
                $table->uuid('task_id');
                $table->timestamps();
    
                $table->uuid('user_id')->foreign('id')->references("partners")->ondelete('cascade');
                $table->uuid('task_id')->foreign('id')->references("tasks")->ondelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_partners');
    }
}
