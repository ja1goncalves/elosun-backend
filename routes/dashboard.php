<?php

use Illuminate\Http\Request;


Route::group(['prefix' => 'providers', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'ProvidersController', ['only' => ['index', 'show']]);
});

Route::group(['prefix' => 'clients', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'ClientsController', ['only' => ['index', 'show']]);
});

Route::group(['prefix' => 'distributors', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'EnergyDistributorsController', ['only' => ['index', 'show']]);
});

Route::group(['prefix' => 'orders', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'OrdersController', ['only' => ['index', 'show']]);
    Route::get('/orders-by-days', 'OrdersController@getOrdersByIntervalDate');
});
