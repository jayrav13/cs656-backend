<?php

use Illuminate\Database\Seeder;

class PlatformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		DB::table('platform')->insert([
			"platform" => "Linux",
			"recruiter_id" => 4
		]);
		DB::table('platform')->insert([
			"platform" => "Windows",
			"recruiter_id" => 4
		]);
        DB::table('platform')->insert([
            "platform" => "Mac OS X",
            "recruiter_id" => 4
        ]);

    }
}
