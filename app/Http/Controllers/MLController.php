<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use App\User;
use App\MLRank;
use Schema;

class MLController extends Controller
{
    //
    public function getStudentList(Request $request) {

    	$user = User::where('user_token', $request->token)->first();
    	$studentList = MLRank::where('recruiter_id', $user->id)->first();
    	$studentList = explode(",", $studentList->rank_id);
    	$json = array();
		foreach ($studentList as $x) {
			$user = User::where('id', $x)->first();
			//$json[] = [ $user ];
            array_push($json, $user);
		}
		// Reply
        return Response::json([
            "status" => "OK",
            "response" => $json
        ], 200);
    }
}
