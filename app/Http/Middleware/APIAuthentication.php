<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use App\User;

class APIAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->has('token')) {
            return Response::json([
                    "status" => "ERROR",
                    "response" => "Authentication failed.",
                    "message" => "Please authenticate the user to use this route by including the \"token\" HTTP parameter with your request."
                ]);
        }
        else {
            $user = User::where('user_token', $request->token)->first();
            if(!$user) {
                return Response::json([
                    "status" => "ERROR",
                    "response" => "User not found.",
                    "message" => "This route requires authentication of the user. Please try again with a valid token. Consider re-logging the user in to get a new token."
                ]);
            }
            else {
                return $next($request);
            }
        }
        
    }
}
