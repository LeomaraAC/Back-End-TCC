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

/*Rotas para autenticação*/
Route::group([

    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh'); // Não está sendo utilizada
    Route::post('me', 'AuthController@me'); // Não está sendo utilizada

});

/*Rotas para grupos de usuários*/
Route::group([

    'prefix' => 'groupUsers'

], function () {

    Route::post('grupo', 'GruposUsersController@store');
    Route::get('grupo/{sort}/{number}/{filter?}', 'GruposUsersController@index');
    Route::get('grupo/{id}', 'GruposUsersController@show');
    Route::delete('grupo/{id}', 'GruposUsersController@destroy');
    Route::put('grupo', 'GruposUsersController@update');

});

Route::group([

    'prefix' => 'function'

], function () {

    Route::get('funcaoSistema', 'FuncoesSistemaController@index');
    Route::post('filtrarFuncao', 'FuncoesSistemaController@filter');

});