<?php

use Illuminate\Http\Request;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('order/sale', 'OrdersController@sale');
Route::post('order/purchase', 'OrdersController@purchase');
