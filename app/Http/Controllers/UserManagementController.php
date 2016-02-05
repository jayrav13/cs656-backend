<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use App\User;

class UserManagementController extends Controller
{
    /*
     *  User login.
     */
    public function loginUser(Request $request) {
        if(!$request->email || !$request->password) {
            return Response::json([
                "status" => "ERROR", 
                "response" => "Login failed.",
                "message" => "Required information (email, password) not provided."
            ]);
        }
        else {
            $user = User::where('email', $request->email)->where('password', md5($request->password))->first();
            if(!$user) {
                return Response::json([
                    "status" => "OK",
                    "response" => "Login failed.",
                    "message" => "Invalid credentials."
                ]);
            }
            else {
                $user->user_token = md5($user->email . time());
                $user->active = 1;
                $user->save();
                return Response::json([
                    "status" => "OK",
                    "respose" => "Login succeeded.",
                    "message" => $user
                ]);
            }
        }
    }

    /*
     *  Create a new user.
     */
    public function registerUser(Request $request) {
        if(!$request->name || !$request->email || !$request->password || !$request->role) {
            return Response::json([
                "status" => "ERROR", 
                "response" => "Registration failed.",
                "message" => "Required information (name, email, password, role) not provided."
            ]);
        }
        else {
            $user = User::where('email', $request->email)->first();
            if($user) {
                return Response::json([
                    "status" => "OK",
                    "response" => "Registration failed.",
                    "message" => "An account under this email address has already been created." 
                ]);
            }
            else {
                $user = User::create(array(
                    "name" => $request->name,
                    "email" => $request->email,
                    "role" => (int) $request->role,
                    "user_token" => md5($request->email . time()),
                    "active" => 1
                ));
                $user->password = md5($request->password);
                $user->save();
                return Response::json([
                    "status" => "OK",
                    "response" => "Registration succeeded.",
                    "message" => $user
                ]);
            }
        }
    }

    /*
     *  Edits user data.
     */
    public function editUser(Request $request) {
        $user = User::where('user_token', $request->token)->first();
        $user->update($request->all());
        $user->save();
        return Response::json([
            "status" => "OK",
            "response" => "User data updated.",
            "message" => $user
        ]);
    }

    /*
     *  Change user password.
     */
    public function changePassword(Request $request) {
        if(!$request->password) {
            return Response::json([
                "status" => "OK",
                "response" => "Password change failed.",
                "message" => "New password required to change password"
            ]);
        }
        else {
            $user = User::where('user_token', $request->token)->first();
            $user->password = md5($request->password);
            $user->save();
            return Response::json([
                "status" => "OK",
                "response" => "Password reset successful.",
                "message" => $user
            ]);
        }
    }

    /*
     *  Delete user.
     */
    public function deleteUser(Request $request) {
        $user = User::where('user_token', $request->token)->first();
        $user->delete();
        return Response::json([
            "status" => "OK",
            "response" => "Delete success",
            "message" => "User has been deleted."
        ]);
    }
}
