<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'users', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'UsersController', ['except' => ['create', 'delete']]);
});

Route::group(['prefix' => 'clients', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'ClientsController', ['except' => ['create', 'delete']]);
});

Route::group(['prefix' => 'providers', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'ProvidersController', ['except' => ['create', 'delete']]);
});

Route::group(['prefix' => 'orders', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'OrdersController', ['except' => ['create', 'delete']]);
});

Route::group(['prefix' => 'distributors', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'EnergyDistributorsController', ['except' => ['create', 'delete']]);
    Route::get('/{id}', 'EnergyDistributorsController@show');
    Route::post('/update-list', 'EnergyDistributorsController@updateCrw');
});

Route::group(['prefix' => 'stations', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'ElectricStationsController', ['except' => ['create', 'delete']]);
    Route::get('/{id}', 'ElectricStationsController@show');
});

Route::group(['prefix' => 'stock', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'Stock\StockController', ['except' => ['create', 'delete']]);
});
