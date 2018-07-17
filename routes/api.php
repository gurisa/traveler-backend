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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//jwt.auth

Route::group(['middleware' => [config('app.debug') ? 'api' : 'api'], 'prefix' => 'v0'], function () { //auth:api
    Route::prefix('users')->group(function() {
        Route::get('{id}/transactions', 'UserController@transactions');
        Route::get('{id}/details', 'UserController@details');
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
        Route::post('', 'RouteController@store');
        Route::patch('{id}', 'RouteController@update');
        Route::delete('{id}', 'RouteController@delete'); 
    });

    Route::prefix('transportations')->group(function() {
        Route::post('{id}/status', 'TransportationController@status');
        Route::post('', 'TransportationController@store');
        Route::patch('{id}', 'TransportationController@update');
        Route::delete('{id}', 'TransportationController@delete');
    });
    
    Route::prefix('transactions')->group(function() {
        Route::get('', 'TransactionController@all');
        Route::get('{id}', 'TransactionController@retrieve');
        Route::post('{id}/paid', 'TransactionController@paid');
        Route::post('{id}/unpaid', 'TransactionController@unpaid');
        Route::post('', 'TransactionController@store');
        Route::patch('{id}', 'TransactionController@update');        
        Route::delete('{id}', 'TransactionController@delete');
    });

    Route::prefix('details')->group(function() {
        Route::get('', 'TransactionDetailController@all');
        Route::get('{id}', 'TransactionDetailController@retrieve');
        Route::post('', 'TransactionDetailController@store');
        Route::patch('{id}', 'TransactionDetailController@update');
        Route::delete('{id}', 'TransactionDetailController@delete');
    });

    Route::prefix('reports')->group(function() {
        Route::get('income', 'ReportController@income');
        Route::get('inventory', 'ReportController@inventory');
    });
});

Route::group(['middleware' => ['api']], function () {
    Route::prefix('v0')->group(function() {
        Route::prefix('auth')->group(function() {            
            Route::post('register', 'AuthController@register');
            Route::post('login', 'AuthController@login');
            Route::post('logout', 'AuthController@logout');
        });
        
        Route::prefix('test')->group(function() {            
            Route::get('', function() {
                return response()->json('Hello world, visit us on: gurisa.com');
            });
        });        
        
        Route::prefix('routes')->group(function() {
            Route::get('', 'RouteController@all');
            Route::get('{id}', 'RouteController@retrieve');
        });
        
        Route::prefix('transportations')->group(function() {
            Route::get('', 'TransportationController@all');
            Route::get('active', 'TransportationController@active');
            Route::get('{id}', 'TransportationController@retrieve');
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
        
    });
});
