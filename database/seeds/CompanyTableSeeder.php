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
        //
        DB::table('company')->insert([
            'company_name' => "Facebook",
            'simple_name' => "facebook"
        ]);
        DB::table('company')->insert([
            'company_name' => "Apple",
            'simple_name' => "apple"
        ]);
        DB::table('company')->insert([
            'company_name' => "Dun and Bradstreet",
            'simple_name' => "dun_and_bradstreet"
        ]);
        DB::table('company')->insert([
            'company_name' => "Exxon Mobile",
            'simple_name' => "exxon_mobile"
        ]);
        DB::table('company')->insert([
            'company_name' => "Qualcomm",
            'simple_name' => "qualcomm"
        ]);

        foreach(App\Company::all() as $company) {
            $company->touch();
            $company->created_at = $company->updated_at;
            $company->save();
        }
    }
}
