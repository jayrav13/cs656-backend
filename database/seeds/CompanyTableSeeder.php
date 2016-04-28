<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(App\Company::all() as $company) {
            $company->touch();
            $company->created_at = $company->updated_at;
            $company->save();
        }
    }
}
