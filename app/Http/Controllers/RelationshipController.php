<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
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
            $this_user = User::where('user_token', $request->token)->first();
            $connecting = User::where('user_token', $request->connection_token)->first();
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

                    $exists = DB::select("select * from student_recruiter where student_id = ? and recruiter_id = ?", $result);

                    if(count($exists) > 0) {
                        return Response::json([
                            "status" => "OK",
                            "response" => "Already a connection.",
                            "message" => "You are already connected to this person! Call /api/v0.1/relationship/list to get an updated list of relationships for this user."
                        ], 200);
                    }
                    else {
                        DB::insert('insert into student_recruiter (student_id, recruiter_id) values (?, ?)', $result);
                        return Response::json([
                            "status" => "OK",
                            "response" => "Add Connection successful.",
                            "message" => "Users have been successfully connected! Call /api/v0.1/relationship/list to get an updated list of relationships for this user."
                        ], 200);
                    }

                    
                }
            }
        }
    }

    private function generateListOutput($user) {
        $result = [];
        $connections = NULL;
        if($user->role == 2) {
            $connections = $user->recruitersConnected;
        }
        else {
            $connections = $user->studentsConnected;
        }
        foreach($connections as $connection) {
            array_push($result, User::with('company')->where('id', $connection->id)->first());
        }
        return $result;
    }
}
