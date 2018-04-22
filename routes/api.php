<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api'], 'prefix' => 'v0'], function () {
    Route::prefix('')->group(function() {

    });
});
 
Route::group(['middleware' => ['api']], function () {
    Route::prefix('v0')->group(function() {
        Route::prefix('tickets')->group(function() {
            Route::get('', 'TicketController@all');
        });
        Route::prefix('users')->group(function() {
            Route::get('', 'UserController@all');
        });
    });
});
