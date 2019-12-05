<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'users'], function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::resource('/', 'UsersController', ['except' => ['create', 'delete']]);
    });
});

Route::group(['prefix' => 'distributors'], function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::resource('/', 'EnergyDistributorsController', ['except' => ['create', 'delete']]);
    });
});
