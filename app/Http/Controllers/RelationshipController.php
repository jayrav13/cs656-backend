<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\UserRelationship;
use Response;
use DB;

class RelationshipController extends Controller
{
    public function connectionsList(Request $request) {
        $user = User::with('company')->where('user_token', $request->token)->first();
        return Response::json([
            "status" => "OK",
            "response" => $this->generateListOutput($user),
            "message" => "List of all individuals connected."
        ], 200);
    }

    public function addConnection(Request $request) {
        if(!$request->connection_token) {
            return Response::json([
                "status" => "ERROR",
                "response" => "Invalid parameters.",
                "message" => "Parameter connection_token required to connect two users."
            ], 400);
        }
        else {
            $this_user = User::where('user_token', $request->token)->with('company')->first();
            $connecting = User::where('user_token', $request->connection_token)->with('company')->first();
            if(!$this_user || !$connecting) {
                return Response::json([
                    "status" => "OK",
                    "response" => "Add Connection failed.",
                    "message" => "One or more of the provided users does not exist."
                ], 400);
            }
            else {
                if($this_user->role == $connecting->role) {
                    return Response::json([
                        "status" => "OK",
                        "response" => "Add Connection failed.",
                        "message" => "At this time, we only support student / recruiter connections. Sorry!"
                    ], 400);
                }
                else {
                    // [Student, Recruiter]
                    $result = [0, 0];

                    if($this_user->role == 1) {
                        $result = [$this_user->id, $connecting->id];
                    }
                    else {
                        $result = [$connecting->id, $this_user->id];
                    }

                    $exists = UserRelationship::where('student_id', $result[0])->where('recruiter_id', $result[1])->first();

                    if(count($exists) > 0) {
                        return Response::json([
                            "status" => "OK",
                            "response" => "Already a connection.",
                            "message" => "You are already connected to this person!"
                        ], 400);
                    }
                    else {
                        $rel = UserRelationship::create([
                            "student_id" => $result[0],
                            "recruiter_id" => $result[1]
                        ]);
                        return Response::json([
                            "status" => "OK",
                            "response" => "Add Connection successful.",
                            "message" => "Users have been successfully connected!",
                            "users" => [
                                "scanner" => $this_user,
                                "scannee" => $connecting,
                                "relationship" => $rel
                            ]
                        ], 200);
                    }
                }
            }
        }
    }

    private function generateListOutput($user) {
        $connections = NULL;
        if($user->role == 2) {
            $connections = $user->studentsConnected;
        }
        else {
            $connections = $user->recruitersConnected;
        }
        return $connections;
    }
}
