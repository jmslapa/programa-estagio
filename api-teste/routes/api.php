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

Route::middleware('api')->group(function() {
    
    // endpoints autenticação
    Route::prefix('auth')->namespace('Api')->group(function() {

        // sign up
        Route::post('sign-up', 'AuthController@signUp')->name('signUp');

        // login
        Route::post('login', 'AuthController@login')->name('login');

        // logout
        Route::post('logout', 'AuthController@logout')->name('logout');

        // refresh
        Route::post('refresh', 'AuthController@refresh')->name('refresh');

        // autenticado
        Route::post('autenticado', 'AuthController@autenticado')->name('autenticado');
    });

    // endpoints api v1
    Route::prefix('v1')->namespace('Api\\V1')->group(function() {

        // endpoints search
        Route::prefix('search')->name('search.')->group(function() {
            
            // Linhas por parada
            Route::get('/paradas/{parada_id}/linhas-por-parada', 'SearchController@linhasPorParada')
            ->name('linhasPorParada');

            // Veiculos por linha
            Route::get('/linhas/{linha_id}/veiculos-por-linha', 'SearchController@veiculosPorLinha')        
            ->name('veiculosPorLinha');

            // Paradas Próximas
            Route::get('/paradas/paradas-proximas', 'SearchController@paradasProximas')
            ->name('paradasProximas');

            // Filtros Parada
            Route::get('/paradas/filtrar', 'SearchController@filtrarParadas')
            ->name('filtrarParadas');
        });

        // endpoints restritos
        Route::middleware('jwt.auth')->namespace('Admin')->group(function() {

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
});



