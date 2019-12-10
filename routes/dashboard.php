<?php

use Illuminate\Http\Request;


Route::group(['prefix' => 'providers', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'ProvidersController', ['only' => ['index', 'show']]);
    Route::get('/bests-by-orders', 'ProvidersController@bestsByOrders');
});

Route::group(['prefix' => 'clients', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'ClientsController', ['only' => ['index', 'show']]);
    Route::get('/bests-by-orders', 'ClientsController@bestsByOrders');
});

Route::group(['prefix' => 'distributors', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'EnergyDistributorsController', ['only' => ['index', 'show']]);
    Route::get('/populars', 'EnergyDistributorsController@populars');
});

Route::group(['prefix' => 'orders', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'OrdersController', ['only' => ['index', 'show']]);
    Route::get('/by-days', 'OrdersController@getOrdersByIntervalDate');
});
