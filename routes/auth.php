<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'user'], function () {
    Route::get('activate/{token}', 'AuthController@signupActivate'); //Ativação de usuario via token em email.

    //Session
    Route::group(['middleware' => ['auth:api']], function () {
        //Auth
        Route::get('/',         'AuthController@getUserAuthenticated'); //Pega o usuario logado.
        Route::delete('logoff', 'AuthController@destroyToken'); //Faz logoff no sistema invalidado o token.
    });
});

//Password Manager
Route::group(['prefix' => 'reset-password'], function () {
    Route::post('/',            'Auth\ResetPasswordController@create'); //Envia solicitação de reset se senha.
    Route::get('/{token}',      'Auth\ResetPasswordController@find'); //Valida Token recebido no email.
    Route::post('reset',        'Auth\ResetPasswordController@reset'); //Recebe os novos dados para o reset de senha.
});
