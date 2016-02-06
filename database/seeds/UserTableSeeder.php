<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Full Seed
        DB::table('users')->insert([
            'name' => "Jay Ravaliya",
            'email' => 'jhr10@njit.edu',
            'password' => md5('testing'),
            'active' => 1,
            'user_token' => md5(str_random(10) . time()),
            'company_id' => 1,
            'twitter' => 'jayrav13',
            'linkedin' => 'jayrav13',
            'resume' => 'http://jayravaliya.com/assets/JayRavaliya_Resume.pdf',
            'website' => 'http://jayravaliya.com'
        ]);
        // Resume Missing
        DB::table('users')->insert([
            'name' => "Saurabh Palaspagar",
            'email' => 'svp@njit.edu',
            'password' => md5('testing'),
            'active' => 1,
            'user_token' => md5(str_random(10) . time()),
            'company_id' => 1,
            'twitter' => 'svp44',
            'linkedin' => 'svp44',
            'website' => 'http://google.com'
        ]);
        // Website Missing
        DB::table('users')->insert([
            'name' => "Dhruva Patel",
            'email' => 'dtp22@njit.edu',
            'password' => md5('testing'),
            'active' => 3,
            'user_token' => md5(str_random(10) . time()),
            'company_id' => 1,
            'twitter' => 'dtp22',
            'linkedin' => 'dtp22',
            'resume' => 'http://google.com.com'
        ]);
        // Twitter Missing
        DB::table('users')->insert([
            'name' => "Ajit Puthenputhussery",
            'email' => 'avp38@njit.edu',
            'password' => md5('testing'),
            'active' => 4,
            'user_token' => md5(str_random(10) . time()),
            'company_id' => 1,
            'linkedin' => 'avp38',
            'resume' => 'http://google.com',
            'website' => 'http://google.com'
        ]);
        // All Optionals Missing
        DB::table('users')->insert([
            'name' => "Nicholas Carbonara",
            'email' => 'ndc4@njit.edu',
            'password' => md5('testing'),
            'active' => 1,
            'user_token' => md5(str_random(10) . time()),
        ]);

        // Set timeStamps
        foreach(App\User::all() as $user) {
            $user->touch();
            $user->created_at = $user->updated_at;
            $user->save();
        }

    }
}
