<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveRoleAddSocialUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function($table) {
            $table->dropColumn('role');
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('resume')->nullable();
            $table->string('website')->nullable();
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
        Schema::table('users', function($table) {
            $table->integer('role')->unsigned();
            $table->dropColumn('twitter');
            $table->dropColumn('linkedin');
            $table->dropColumn('resume');
            $table->dropColumn('website');
        });
    }
}
