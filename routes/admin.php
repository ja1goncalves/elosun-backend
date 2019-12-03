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

Route::group(['middleware' => ['auth:api']], function () {
    //Auth
    Route::get('authenticated',     'AuthController@getUserAuthenticated'); //Pega o usuario logado.
    Route::get('activate/{token}',  'AuthController@signupActivate'); //Ativação de usuario via token em email.
    Route::delete('logoff',         'AuthController@destroyToken'); //Faz logoff no sistema invalidado o token.
});
