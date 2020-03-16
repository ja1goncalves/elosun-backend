<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'users', 'middleware' => ['auth:api']], function () {
    Route::post('/', 'UsersController@index');
    Route::get('/{id}', 'UsersController@show');
    Route::put('/update', 'UsersController@update');
});

Route::group(['prefix' => 'clients', 'middleware' => ['auth:api']], function () {
    Route::post('/', 'ClientsController@index');
    Route::get('/{id}', 'ClientsController@show');
    Route::put('/update', 'ClientsController@update');
});

Route::group(['prefix' => 'providers', 'middleware' => ['auth:api']], function () {
    Route::post('/', 'ProvidersController@index');
    Route::get('/{id}', 'ProvidersController@show');
    Route::put('/update', 'ProvidersController@update');
});

Route::group(['prefix' => 'orders', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'OrdersController', ['except' => ['create', 'delete']]);
});

Route::group(['prefix' => 'distributors', 'middleware' => []], function () {
    Route::post('/', 'EnergyDistributorsController@index');
    Route::get('/{id}', 'EnergyDistributorsController@show');
    Route::post('/update-list', 'EnergyDistributorsController@updateCrw');
});

Route::group(['prefix' => 'stations', 'middleware' => ['auth:api']], function () {
    Route::post('/', 'ElectricStationsController@index');
    Route::get('/{id}', 'ElectricStationsController@show');
});

Route::group(['prefix' => 'stock', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'Stock\StockController', ['except' => ['create', 'delete']]);
});
