<?php

use Illuminate\Http\Request;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('order/sale', 'OrdersController@sale');
Route::post('order/purchase', 'OrdersController@purchase');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user', 'UsersController@getUserProviderOrClient');
    Route::get('/dono-do-pedido/{id}', 'OrdersController@getOrderly');
    Route::get('distributors-initials', 'EnergyDistributorsController@getInitials');
    Route::get('phases', 'ElectricAccountController@allPhases');
    Route::get('tipos-de-consumo', 'ElectricAccountController@consumptionTypes');

    Route::group(['prefix' => 'fornecedor'], function () {
        Route::post('cadastro-por-pedido', 'ProvidersController@updateProviderByOrder');
    });
    Route::group(['prefix' => 'cliente'], function () {
        Route::post('cadastro-por-pedido', 'ClientsController@updateClientByOrder');
    });
});
