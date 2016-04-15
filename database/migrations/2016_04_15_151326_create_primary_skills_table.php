<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrimarySkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primary_skills', function (Blueprint $table) {  
            $table->integer('recruiter_id')->unsigned();
            $table->foreign('recruiter_id')->references('id')->on('users'); 
            $table->string('skill');
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
        Schema::drop('primary_skills');
    }
}
