<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        App\User::unguard();
        App\Company::unguard();
        App\PrimarySkills::unguard();
        App\SecondarySkills::unguard();
        App\Platform::unguard();

        $this->call(CompanyTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(PrimarySkillsTableSeeder::class);
        $this->call(SecondarySkillsTableSeeder::class);
        $this->call(PlatformsTableSeeder::class);

        App\Platform::reguard();
        App\SecondarySkills::reguard();
        App\PrimarySkills::reguard();
        App\Company::reguard();
        App\User::reguard();

    }
}
