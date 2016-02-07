<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleToCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Correction - this is to add role to USERS table!!!
        Schema::table('users', function($table) {
            $table->integer('role')->unsigned()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Correction - this is to drop role from USERS table!!!
        Schema::table('users', function($table) {
            $table->dropColumn('role');
        });
    }
}
