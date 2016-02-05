<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api/v0.1'], function() {

    // Make sure the API is working.
    Route::get('/heartbeat', function() {
        return Response::json(["response" => "OK"]);
    });

    Route::get('/docs', function() {
        return view('docs', ['users' => App\User::all()]);
    });

    // User Management Routes
    Route::get('/user/login', "UserManagementController@loginUser");
    Route::post('/user/register', "UserManagementController@registerUser");
    Route::group(['middleware' => ['customauth']], function() {
        Route::put('/user/edit', "UserManagementController@editUser");
        Route::patch('/user/password', "UserManagementController@changePassword");
        Route::delete('/user/delete', "UserManagementController@deleteUser");
    });

});



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
