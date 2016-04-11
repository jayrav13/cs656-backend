<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use App\User;
use App\Chat;
use Schema;


class ChatController extends Controller
{
    //Insert Chat
    public function addChat(Request $request) {

    	//Checks if required parameters are provided
        if(!$request->message || !$request->from_user_id || !$request->to_user_id) {
            return Response::json([
                "status" => "ERROR",
                "response" => "Message insertion failed"
            ], 400);
        }
        $fromUser = User::where('id', $request->from_user_id)->first();
        $toUser = User::where('id', $request->to_user_id)->first();

        //Checks if from and to user exists
        if(!$fromUser || !$toUser) {
            return Response::json([
                "status" => "ERROR",
                "response" => "Message insertion failed"
            ], 400);
        }

        //Insert the message into database
        $chat = Chat::create(array(
                    "message" => $request->message,
                    "from_user_id" => $request->from_user_id,
                    "to_user_id" => $request->to_user_id
                ));
        $chat->save();

        //Reply
        return Response::json([
            "status" => "OK",
            "response" => $chat
        ], 200);
    }
    //Retrive Chat
    public function getChat(Request $request) {

    	//Checks if required parameters are provided
        if(!$request->from_user_id || !$request->to_user_id) {
            return Response::json([
                "status" => "ERROR",
                "response" => "Message fetching failed"
            ], 400);
        }
        $fromUser = User::where('id', $request->from_user_id)->first();
        $toUser = User::where('id', $request->to_user_id)->first();

        //Checks if from and to user exists
        if(!$fromUser || !$toUser) {
            return Response::json([
                "status" => "ERROR",
                "response" => "Message fetching failed"
            ], 400);
        }

        //Insert the message into database
        $chat = Chat::where('from_user_id', $request->from_user_id)->where('to_user_id', $request->to_user_id)->get();

        //Reply
        return Response::json([
            "status" => "OK",
            "response" => $chat
        ], 200);
    }
}
