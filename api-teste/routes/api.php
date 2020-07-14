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

// endpoints api v1
Route::prefix('v1')->namespace('Api\\V1')->group(function() {

    // endpoints search
    Route::prefix('search')->name('search.')->group(function() {
        
        // Linhas por parada
        Route::get('/{parada_id}/linhas-por-parada', 'SearchController@linhasPorParada')
        ->name('linhasPorParada');
        // Linhas por parada
        Route::get('/{linha_id}/veiculos-por-linha', 'SearchController@veiculosPorLinha')
        ->name('veiculosPorLinha');
    });

    // endpoints restritos
    Route::namespace('Admin')->group(function() {

        // endpoints users
        Route::resource('/users', 'UserController');

        // endpoints paradas 
        Route::resource('/paradas', 'ParadaController');

        // endpoints linhas 
        Route::resource('/linhas', 'LinhaController');
        Route::name('linhas.')->group(function() {
            Route::delete('/linhas/{id}/paradas', 'LinhaController@removeParadas')->name('removeParadas');
        });

        // endpoints de veiculos
        Route::resource('/veiculos', 'VeiculoController');

        // endpoints de posicaoVeiculos
        Route::prefix('posicao-veiculos')->name('posicaoVeiculos.')->group(function() {
            Route::get('/', 'PosicaoVeiculoController@index')->name('index');
            //Route::post('/', 'PosicaoVeiculoController@store')->name('store');
            Route::get('/{id}', 'PosicaoVeiculoController@show')->name('show');        
            Route::put('/{id}', 'PosicaoVeiculoController@update')->name('update');                
            //Route::delete('/{id}', 'PosicaoVeiculoController@destroy')->name('destroy');
        });
    });

});

