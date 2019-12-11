<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInvitationUserIdToAuthTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_auths', function (Blueprint $table) {
            // HACK: 影響範囲考えた保険 想像していない導線でpartner_authsが作成されることを考慮してnullableにしてる
            //       想像していない導線がなくなった段階でnullable外したい
            $table->uuid('invitation_user_id')->after('company_id')->nullable();
            $table->foreign('invitation_user_id')->references('id')->on('company_users');
        });

        Schema::table('company_user_auths', function (Blueprint $table) {
            $table->uuid('invitation_user_id')->after('company_id')->nullable();
            $table->foreign('invitation_user_id')->references('id')->on('company_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner_auths', function (Blueprint $table) {
            $table->dropForeign('partner_auths_invitation_user_id_foreign');
            $table->dropColumn('invitation_user_id');
        });

        Schema::table('company_user_auths', function (Blueprint $table) {
            $table->dropForeign('company_user_auths_invitation_user_id_foreign');
            $table->dropColumn('invitation_user_id');
        });
    }
}
