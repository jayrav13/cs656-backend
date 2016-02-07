<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Company;
use App\User;
use DB;
use Response;

class CompanyController extends Controller
{

    public function companies() {
        return Response::json([
            'status' => "OK",
            "response" => Company::has('user')->with('user')->get(),
            "message" => "A list of companies with 1+ recruiters attending. A comprehensive list of companies can be found in the /api/v0.1/company/search route."
        ]);
    }

    public function recruiters() {
        return Response::json([
            'status' => "OK",
            "response" => User::where('role', 2)->with('company')->get(),
            "message" => "A list of all recruiters attending."
        ]);
    }

    public function search(Request $request) {
        return Response::json([
            'status' => "OK",
            "message" => "A list of all companies and current recruiter count. To be used for lightweight operations such as search.",
            "response" => Company::leftJoin('users', 'company.id', '=', 'users.company_id')->select('company.id', 'company.company_name', DB::raw('count(users.id) as recruiter_count'))->orderBy('company_name')->groupBy('company_name')->get(),
        ]);
    }
}
