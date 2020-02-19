<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'users', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'UsersController', ['except' => ['create', 'delete']]);
    Route::post('/search', 'UsersController@searchs');
});

Route::group(['prefix' => 'clients', 'middleware' => []], function () {
    Route::resource('/', 'ClientsController', ['except' => ['create', 'delete']]);
    Route::get('/lead', 'ClientsController@listLead');
    Route::post('/search', 'ClientsController@searchs');
    Route::post('/lead/search', 'ClientsController@searchs');
});

Route::group(['prefix' => 'providers', 'middleware' => []], function () {
    Route::resource('/', 'ProvidersController', ['except' => ['create', 'delete']]);
    Route::get('/lead', 'ProvidersController@listLead');
    Route::post('/search', 'ProvidersController@searchs');
    Route::post('/lead/search', 'ProvidersController@leadSearchs');
});

Route::group(['prefix' => 'orders', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'OrdersController', ['except' => ['create', 'delete']]);
});

Route::group(['prefix' => 'distributors', 'middleware' => []], function () {
    Route::resource('/', 'EnergyDistributorsController', ['except' => ['create', 'delete']]);
    Route::get('/{id}', 'EnergyDistributorsController@show');
    Route::post('/update-list', 'EnergyDistributorsController@updateCrw');
    Route::post('/search', 'EnergyDistributorsController@searchs');
});

Route::group(['prefix' => 'stations', 'middleware' => []], function () {
    Route::resource('/', 'ElectricStationsController', ['except' => ['create', 'delete']]);
    Route::get('/{id}', 'ElectricStationsController@show');
    Route::post('/search', 'ElectricStationsController@searchs');
});

Route::group(['prefix' => 'stock', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'Stock\StockController', ['except' => ['create', 'delete']]);
});
