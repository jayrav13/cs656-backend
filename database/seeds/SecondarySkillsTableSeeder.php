<?php

use Illuminate\Database\Seeder;

class SecondarySkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('secondary_skills')->insert([
			"skill" => "JavaScript",
			"recruiter_id" => 2
		]);
		DB::table('secondary_skills')->insert([
			"skill" => "jQuery",
			"recruiter_id" => 2
		]);
		DB::table('secondary_skills')->insert([
			"skill" => "NGINX",
			"recruiter_id" => 2
		]);
		DB::table('secondary_skills')->insert([
			"skill" => "d3.js",
			"recruiter_id" => 2
		]);
    }
}
