<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserColumnToChats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('chats', function($table) {
            $table->integer('from_user_id')->unsigned();
            $table->foreign('from_user_id')->references('id')->on('users');
            $table->integer('to_user_id')->unsigned();
            $table->foreign('to_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('chats', function($table) {
            $table->dropForeign('chats_from_user_id_foreign');
            $table->dropColumn('from_user_id');
            $table->dropForeign('chats_to_user_id_foreign');
            $table->dropColumn('to_user_id');
        });
    }
}
