<?php

use Illuminate\Database\Seeder;

class PrimarySkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('primary_skills')->insert([
			"skill" => "PHP",
			"recruiter_id" => 4
        ]);
		DB::table('primary_skills')->insert([
			"skill" => "MySQL",
			"recruiter_id" => 4
		]);
		DB::table('primary_skills')->insert([
			"skill" => "Apache",
			"recruiter_id" => 4
		]);
		DB::table('primary_skills')->insert([
			"skill" => "REST",
			"recruiter_id" => 4
		]);
        DB::table('primary_skills')->insert([
            "skill" => "NGINX",
            "recruiter_id" => 4
        ]);

	 }

}
