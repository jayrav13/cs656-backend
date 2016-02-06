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
        return view('docs', ['users' => App\User::all(), 'companies' => App\Company::with('user')->get()]);
    });

    // User Management Routes
    Route::group(['prefix' => 'user'], function() {
        Route::get('/login', "UserManagementController@loginUser");
        Route::post('/register', "UserManagementController@registerUser");
        Route::group(['middleware' => ['customauth']], function() {
            Route::put('/edit', "UserManagementController@editUser");
            Route::patch('/password', "UserManagementController@changePassword");
            Route::post('/logout', "UserManagementController@logoutUser");
            Route::delete('/deactivate', "UserManagementController@deactivateUser");
        });
    });
    

    // Company Routes
    Route::group(['middleware' => ['customauth'], 'prefix' => 'company'], function() {
        Route::get('/companies', "CompanyController@companies");
        Route::get('/recruiters', "CompanyController@recruiters");
    });

    // Relationship Routes
    Route::group(['middleware' => ['customauth'], 'prefix' => 'relationship'], function() {
        Route::get('/list', "RelationshipController@connectionsList");
        Route::post('/add', "RelationshipController@addConnection");
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
