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

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api\\V1\\Admin',
], function() {

    Route::group([
        'prefix' => 'users',
        'name' => 'users.'
    ], function() {
        Route::get('/', 'UserController@index');
    });

});