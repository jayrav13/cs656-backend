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

        $this->call(CompanyTableSeeder::class);
        $this->call(UserTableSeeder::class);

        App\Company::reguard();
        App\User::reguard();

    }
}
