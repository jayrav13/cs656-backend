<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use App\User;
use App\Company;
use Schema;

class UserManagementController extends Controller
{
    /*
     *  User login.
     */
    public function loginUser(Request $request) {

        // Reject if email and password are not provided.
        if(!$request->email || !$request->password) {
            return Response::json([
                "status" => "ERROR", 
                "response" => "Login failed.",
                "message" => "Required information (email, password) not provided."
            ], 400)->header('Access-Control-Allow-Origin', '*');
        }
        else {
            $user = User::where('email', $request->email)->where('password', md5($request->password))->with('company')->first();
            // Reject if authentication fails.
            if(!$user) {
                return Response::json([
                    "status" => "OK",
                    "response" => "Login failed.",
                    "message" => "Invalid credentials."
                ], 400)->header('Access-Control-Allow-Origin', '*');
            }
            // Authentication success. Set new token and activate user.
            else {
                $user->user_token = md5($user->email . time());
                $user->active = 1;
                $user->save();
                return Response::json([
                    "status" => "OK",
                    "response" => "Login succeeded.",
                    "message" => [
                        'user' => $user,
                        // Token is guarded, only made available to client during login and registration.
                        'token' => $user->user_token,
                    ]
                ], 200)->header('Access-Control-Allow-Origin', '*');
            }
        }
    }

    /*
     *  Create a new user.
     */
    public function registerUser(Request $request) {
        // Reject if name, email, password and role are not provided.
        if(!$request->name || !$request->email || !$request->password) {
            return Response::json([
                "status" => "ERROR", 
                "response" => "Registration failed.",
                "message" => "Required information (name, email, password) not provided."
            ], 400)->header('Access-Control-Allow-Origin', '*');
        }
        else {
            $user = User::where('email', $request->email)->first();
            // Reject if username is taken.
            if($user) {
                return Response::json([
                    "status" => "OK",
                    "response" => "Registration failed.",
                    "message" => "An account under this email address has already been created." 
                ], 400)->header('Access-Control-Allow-Origin', '*');
            }
            // Creation success. Create user. Encrypt token and password.
            else {
                $user = User::create(array(
                    "name" => $request->name,
                    "email" => $request->email,
                    "active" => 1
                ));
                $user->user_token = md5($request->email . time());
                $user->password = md5($request->password);

                // Check if company was provided.
                if($request->company_id) {
                    $user->company_id = $request->company_id;
                    if($request->company_id > 0) {
                        $user->role = 2;
                    }
                    else {
                        $user->role = 1;
                    }
                }

                // Save user, reply.
                $user->save();
                return Response::json([
                    "status" => "OK",
                    "response" => "Registration succeeded.",
                    "message" => [
                        'user' => $user,
                        // Token is guarded, only made available to client during login and registration.
                        'token' => $user->user_token
                    ]
                ], 200)->header('Access-Control-Allow-Origin', '*');
            }
        }
    }

    /*
     *  Edits user data.
     */
    public function editUser(Request $request) {
        $user = User::where('user_token', $request->token)->first();

        if($request->email){
            $user1 = User::where('email', $request->email)->first();
            // Reject if Email is taken.
            if($user1) {
                return Response::json([
                    "status" => "OK",
                    "response" => "Update failed.",
                    "message" => "An account under this email address has already been created."
                ], 400);
            }
        }

        $user->fill($request->all());

        // Check if company was provided.
        if($request->company_id) {
            if($request->company_id > 0) {
                $user->role = 2;
                $user->company_id = $request->company_id;
            }
            else {
                $user->role = 1;
                $user->company_id = NULL;
            }
        }

        $user->save();

        return Response::json([
            "status" => "OK",
            "response" => "User data updated.",
            "message" => $user
        ], 200);
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
            ], 400);
        }
        else {
            $user = User::where('user_token', $request->token)->first();
            $user->password = md5($request->password);
            $user->save();
            return Response::json([
                "status" => "OK",
                "response" => "Password reset successful.",
                "message" => $user
            ], 200);
        }
    }

    /*
     *  Delete user.
     */
    public function deactivateUser(Request $request) {
        $user = User::where('user_token', $request->token)->first();
        $user->active = 0;
        $user->save();
        return Response::json([
            "status" => "OK",
            "response" => "Deactivate success.",
            "message" => "User has been deactivated. To reactivate, simply log in with your original credentials."
        ], 200);
    }

    public function logoutUser(Request $request) {
        $user = User::where('user_token', $request->token)->first();
        $user->user_token = NULL;
        $user->save();
        return Response::json([
            "status" => "OK",
            "response" => "Logged out.",
            "message" => "Logged out successfully."
        ], 200);
    }

    public function getUser(Request $request) {
        return Response::json([
            "status" => "OK",
            "response" => User::where('user_token', $request->token)->with('company')->with('recruitersConnected')->with('studentsConnected')->first()
        ], 200);
    }
}
