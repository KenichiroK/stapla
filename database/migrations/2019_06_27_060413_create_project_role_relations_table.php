<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectRoleRelationsTable extends Migration
{
    public function up()
    {
        Schema::create('project_role_relations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->uuid('project_id');
            $table->uuid('superior_id');
            $table->uuid('accounting_id');
            $table->uuid('manager_id');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_role_relations');
    }
}
