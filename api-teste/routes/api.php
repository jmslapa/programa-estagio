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

    // endpoints users
    Route::resource('/users', 'UserController');

    // endpoints paradas 
    Route::resource('/paradas', 'ParadaController');

    // endpoints linhas 
    Route::resource('/linhas', 'LinhaController');
});