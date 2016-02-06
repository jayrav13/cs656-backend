<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Response;

class RelationshipController extends Controller
{
    public function connectionsList(Request $request) {
        $user = User::with('company')->where('user_token', $request->token)->first();
        if($user->company_id == NULL) {
            return Response::json([
                "status" => "OK",
                "response" => $this->generateListOutput($user->recruitersConnected),
                "message" => "List of all recruiters connected."
            ]);
        }
        else {
            return Response::json([
                "status" => "OK",
                "response" => $this->generateListOutput($user->studentsConnected)
            ]);
        }
    }

    private function generateListOutput($connections) {
        $result = [];
        foreach($connections as $connection) {
            array_push($result, User::with('company')->where('id', $connection->id)->first());
        }
        return $result;
    }
}
