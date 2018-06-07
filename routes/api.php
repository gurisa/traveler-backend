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
            Route::get('{id}', 'UserController@retrieve');
            Route::post('', 'UserController@store');
            Route::patch('{id}', 'UserController@update');
            Route::delete('{id}', 'UserController@delete');            
        });
        
        Route::prefix('employees')->group(function() {
            Route::get('', 'EmployeeController@all');
            Route::get('{id}', 'EmployeeController@retrieve');
            Route::post('', 'EmployeeController@store');
            Route::patch('{id}', 'EmployeeController@update');
            Route::delete('{id}', 'EmployeeController@delete');
        });
        
        Route::prefix('routes')->group(function() {
            Route::get('', 'RouteController@all');
            Route::get('{id}', 'RouteController@retrieve');
            Route::post('', 'RouteController@store');
            Route::patch('{id}', 'RouteController@update');
            Route::delete('{id}', 'RouteController@delete'); 
        });

        Route::prefix('seats')->group(function() {
            Route::get('', 'SeatController@all');
            Route::get('{id}', 'SeatController@retrieve');
        });
        
        Route::prefix('transportations')->group(function() {
            Route::get('', 'TransportationController@all');
            Route::get('{id}', 'TransportationController@retrieve');
            Route::post('', 'TransportationController@store');
            Route::patch('{id}', 'TransportationController@update');
            Route::delete('{id}', 'TransportationController@delete'); 
        });

        Route::prefix('countries')->group(function() {
            Route::get('', 'CountryController@all');
            Route::get('{id}', 'CountryController@retrieve');
        });

        Route::prefix('provinces')->group(function() {
            Route::get('', 'ProvinceController@all');
            Route::get('{id}', 'ProvinceController@retrieve');
        });
        
        Route::prefix('regencies')->group(function() {
            Route::get('', 'RegencyController@all');
            Route::get('{id}', 'RegencyController@retrieve');
        });

        Route::prefix('villages')->group(function() {
            Route::get('', 'VillageController@all');
            Route::get('{id}', 'VillageController@retrieve');
        });

        Route::prefix('transactions')->group(function() {
            Route::get('', 'TransactionController@all');
            Route::get('{id}', 'TransactionController@retrieve');
            Route::post('', 'TransactionController@store');
            Route::patch('{id}', 'TransactionController@update');
            Route::delete('{id}', 'TransactionController@delete');
        });

        Route::prefix('transactions/details')->group(function() {
            Route::get('', 'TransactionDetailController@all');
            Route::get('{id}', 'TransactionDetailController@retrieve');
            Route::post('', 'TransactionDetailController@store');
            Route::patch('{id}', 'TransactionDetailController@update');
            Route::delete('{id}', 'TransactionDetailController@delete');
        });

    });
});
