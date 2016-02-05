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
            return Response::json(["response" => "Need a token!"]);
        }
        else {
            $user = User::where('user_token', $request->token)->first();
            if(!$user) {
                return Response::json(["response" => "User not found!"]);
            }
            else {
                return $next($request);
            }
        }
        
    }
}
