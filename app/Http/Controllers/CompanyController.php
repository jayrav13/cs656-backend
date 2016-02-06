<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Company;
use App\User;

use Response;

class CompanyController extends Controller
{

    public function companies() {
        return Response::json([
            'status' => "OK",
            "response" => Company::with('user')->get()
        ]);
    }

    public function recruiters() {
        return Response::json([
            'status' => "OK",
            "response" => User::whereNotNull('company_id')->with('company')->get()
        ]);
    }
}
