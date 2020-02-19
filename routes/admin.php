<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'users', 'middleware' => []], function () {
    Route::resource('/', 'UsersController', ['except' => ['create', 'delete']]);
});

Route::group(['prefix' => 'clients', 'middleware' => []], function () {
    Route::post('/', 'ClientsController@index');
    //Route::resource('/lead', 'ClientsController@listLead', ['except' => ['create', 'delete']]);
});

Route::group(['prefix' => 'providers', 'middleware' => []], function () {
    Route::resource('/', 'ProvidersController', ['except' => ['create', 'delete']]);
    Route::get('/lead', 'ProvidersController@listLead');
});

Route::group(['prefix' => 'orders', 'middleware' => []], function () {
    Route::resource('/', 'OrdersController', ['except' => ['create', 'delete']]);
});

Route::group(['prefix' => 'distributors', 'middleware' => []], function () {
    Route::resource('/', 'EnergyDistributorsController', ['except' => ['create', 'delete']]);
    Route::get('/{id}', 'EnergyDistributorsController@show');
    Route::post('/update-list', 'EnergyDistributorsController@updateCrw');
});

Route::group(['prefix' => 'stations', 'middleware' => []], function () {
    Route::resource('/', 'ElectricStationsController', ['except' => ['create', 'delete']]);
    Route::get('/{id}', 'ElectricStationsController@show');
});

Route::group(['prefix' => 'stock', 'middleware' => []], function () {
    Route::resource('/', 'Stock\StockController', ['except' => ['create', 'delete']]);
});
