<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'users', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'UsersController', ['except' => ['create', 'delete']]);
});

Route::group(['prefix' => 'distributors', 'middleware' => ['auth:api']], function () {
    Route::resource('/', 'EnergyDistributorsController', ['except' => ['create', 'delete']]);
});
