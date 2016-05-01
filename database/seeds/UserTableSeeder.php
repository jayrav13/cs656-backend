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
        // Student
        DB::table('users')->insert([
            'name' => "Jay Ravaliya",
            'email' => 'jhr3@njit.edu',
            'password' => md5('testing'),
            'active' => 1,
            'user_token' => md5(str_random(10) . time()),
            'twitter' => 'jayrav13',
            'linkedin' => 'jayrav13',
            'resume' => 'http://jayravaliya.com/assets/JayRavaliya_Resume.pdf',
            'website' => 'http://jayravaliya.com',
            'role' => 1
        ]);
        // Resume Missing
        // Recruiter
        DB::table('users')->insert([
            'name' => "Saurabh Palaspagar",
            'email' => 'svp44@njit.edu',
            'password' => md5('testing'),
            'active' => 1,
            'user_token' => md5(str_random(10) . time()),
            'company_id' => 1,
            'twitter' => 'svp44',
            'linkedin' => 'svp44',
            'website' => 'http://www.saurabhpalaspagar.com',
            'role' => 2
        ]);
        // Website and Resume Missing
        // Student
        DB::table('users')->insert([
            'name' => "Dhruva Patel",
            'email' => 'dtp22@njit.edu',
            'password' => md5('testing'),
            'active' => 1,
            'user_token' => md5(str_random(10) . time()),
            'twitter' => 'dtp22',
            'linkedin' => 'dtp22',
            'role' => 1
        ]);

        // Recruiter
        DB::table('users')->insert([
            'name' => "Anish Vaghela",
            'email' => "anish.vaghela@gmail.com",
            'password' => md5('testing'),
            'active' => 1,
            'company_id' => 100,
            'twitter' => 'AnishVaghela',
            'linkedin' => 'anishvaghela',
            'user_token' => md5(str_random(10) . time()),
            'role' => 2
        ]);

        // Twitter and Linkedin Missing
        // Student
        DB::table('users')->insert([
            'name' => "Ajit Puthenputhussery",
            'email' => 'avp38@njit.edu',
            'password' => md5('testing'),
            'active' => 1,
            'user_token' => md5(str_random(10) . time()),
            'resume' => 'http://ajitvarghese.com/resume/resume.pdf',
            'website' => 'http://ajitvarghese.com/',
            'role' => 1
        ]);
        
        // STUDENTS
        DB::table('users')->insert([
            'name' => "Nicholas Carbonara",
            'email' => 'ndc4@njit.edu',
            'password' => md5('testing'),
            'active' => 1,
            'user_token' => md5(str_random(10) . time()),
            'role' => 1
        ]);

        DB::table('users')->insert([
            'name' => "Neil Patel",
            'email' => "neil1023@yahoo.com",
            'password' => md5('testing'),
            'active' => 1,
            'user_token' => md5(str_random(10) . time()),
            'twitter' => 'neilpatel1023',
            'linkedin' => 'neil-patel-b05ab083',
            'resume' => 'http://www.eden.rutgers.edu/~np366/Neil_Resume.pdf',
            'website' => 'http://www.eden.rutgers.edu/~np366/',
            'role' => 1
        ]);

        DB::table('users')->insert([
            'name' => "Sakib Jalal",
            'email' => 'sakib.jalal@gmail.com',
            'password' => md5('testing'),
            'active' => 1,
            'user_token' => md5(str_random(10) . time()),
            'twitter' => 'sakib_jalal',
            'linkedin' => 'sakibj',
            'website' => 'http://sakib.github.io/',
            'role' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'Varun Shah',
            'email' => 'thevarunshah@gmail.com',
            'password' => md5('testing'),
            'active' => 1,
            'user_token' => md5(str_random(10) . time()),
            'linkedin' => 'thevarunshah',
            'twitter' => 'thevarunshah',
            'role' => 1
        ]);

        // Set timeStamps
        foreach(App\User::all() as $user) {
            $user->touch();
            $user->created_at = $user->updated_at;
            $user->save();
        }

    }
}
