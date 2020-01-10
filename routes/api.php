<?php

use Illuminate\Http\Request;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('order/sale', 'OrdersController@sale');
Route::post('order/purchase', 'OrdersController@purchase');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/user-plus', 'UsersController@userPlus');
    Route::get('/dono-do-pedido/{id}', 'OrdersController@getOrderly');

    Route::group(['prefix' => 'fornecedor'], function () {
        Route::post('cadastro-por-pedido', 'ProvidersController@updateProviderByOrder');
    });
    Route::group(['prefix' => 'cliente'], function () {
        Route::post('cadastro-por-pedido', 'ClientsController@updateClientByOrder');
    });
});
