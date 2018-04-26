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
        Route::prefix('users')->group(function() {
            Route::get('', 'UserController@all');
        });
        Route::prefix('employees')->group(function() {
            Route::get('', 'EmployeeController@all');
        });
        Route::prefix('routes')->group(function() {
            Route::get('', 'RouteController@all');
        });
        Route::prefix('tickets')->group(function() {
            Route::get('', 'TicketController@all');
        });
        Route::prefix('seats')->group(function() {
            Route::get('', 'SeatController@all');
        });
        Route::prefix('transportations')->group(function() {
            Route::get('', 'TransportationController@all');
        });
        Route::prefix('provinces')->group(function() {
            Route::get('', 'ProvinceController@all');
        });
        Route::prefix('regencies')->group(function() {
            Route::get('', 'RegencyController@all');
        });
    });
});
