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
			"recruiter_id" => 4
		]);

		DB::table('secondary_skills')->insert([
			"skill" => "jQuery",
			"recruiter_id" => 4
		]);

		DB::table('secondary_skills')->insert([
			"skill" => "d3.js",
			"recruiter_id" => 4
		]);

        DB::table('secondary_skills')->insert([
            "skill" => "Bootstrap",
            "recruiter_id" => 4
        ]);

        DB::table('secondary_skills')->insert([
            "skill" => "MaterializeCSS",
            "recruiter_id" => 4
        ]);
    }
}
