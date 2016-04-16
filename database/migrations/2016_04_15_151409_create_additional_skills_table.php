<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_skills', function (Blueprint $table) {
            $table->integer('recruiter_id')->unsigned()->unique();
            $table->foreign('recruiter_id')->references('id')->on('users'); 
            $table->integer('research_exp')->default(0);
            $table->integer('industry_exp')->default(0);
            $table->integer('leadership')->default(0);
            $table->integer('gpa_required')->default(0);
            $table->decimal('gpa_threshold',2,1)->default(0.0);
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
        Schema::drop('additional_skills');
    }
}
