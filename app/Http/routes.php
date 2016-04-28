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
        return Response::json(["response" => "OK"])->header('Access-Control-Allow-Origin', '*');
    });

    Route::get('/docs', function(Request $request) {
        return view('docs', ['users' => App\User::all(), 'companies' => App\Company::with('user')->get(), 'request' => $request]);
    });

    // User Management Routes
    Route::group(['prefix' => 'user'], function() {
        Route::post('/login', "UserManagementController@loginUser");
        Route::post('/register', "UserManagementController@registerUser");
        Route::group(['middleware' => ['customauth']], function() {
            Route::put('/edit', "UserManagementController@editUser");
            Route::patch('/password', "UserManagementController@changePassword");
            Route::post('/logout', "UserManagementController@logoutUser");
            Route::delete('/deactivate', "UserManagementController@deactivateUser");
            Route::get('/get', "UserManagementController@getUser");
        });
    });

    // Chat Routes
    Route::group(['middleware' => ['customauth'], 'prefix' => 'chat'], function() {
        Route::post('/add', "ChatController@addChat");
        Route::get('/get', "ChatController@getChat");
        Route::post('/delete', "ChatController@deleteChat");
        Route::post('/conversation/delete', "ChatController@deleteConversation");
    });
    

    // Company Routes
    Route::group(['middleware' => ['customauth'], 'prefix' => 'company'], function() {
        Route::get('/companies', "CompanyController@companies");
        Route::get('/recruiters', "CompanyController@recruiters");
        Route::get('/search', "CompanyController@search");
    });

    // Relationship Routes
    Route::group(['middleware' => ['customauth'], 'prefix' => 'relationship'], function() {
        Route::get('/list', "RelationshipController@connectionsList");
        Route::post('/add', "RelationshipController@addConnection");
    });

    // Job Routes
    Route::group(['middleware' => ['customauth'], 'prefix' => 'job'], function() {
        
        Route::group(['prefix' => 'primary/skills'], function() {
            Route::post('/add', "JobController@addPrimarySkill");
            Route::get('/get', "JobController@getPrimarySkills");
            Route::post('/delete', "JobController@deletePrimarySkill");
        });
        Route::group(['prefix' => 'secondary/skills'], function() {
            Route::post('/add', "JobController@addSecondarySkill");
            Route::get('/get', "JobController@getSecondarySkills");
            Route::post('/delete', "JobController@deleteSecondarySkill");
        });
        Route::group(['prefix' => 'platform'], function() {
            Route::post('/add', "JobController@addPlatform");
            Route::get('/get', "JobController@getPlatforms");
            Route::post('/delete', "JobController@deletePlatform");
        });
        Route::group(['prefix' => 'additional/skills'], function() {
            Route::post('/add', "JobController@addAdditionalSkill");
            Route::get('/get', "JobController@getAdditionalSkill");
        });
        Route::get('/get', "JobController@getJob");
    });

    // ML
    Route::group(['middleware' => ['customauth'], 'prefix' => 'ml'], function() {
        Route::get('/get', "MLController@getStudentList");
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
