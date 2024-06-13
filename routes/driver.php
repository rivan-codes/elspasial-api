<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController');
    Route::post('register', 'RegisterController');

    Route::group(['middleware' => 'auth:driver'], function () {
        Route::get('profile', 'ProfileController');
        Route::post('logout', 'LogoutController');
    });
});

Route::group(['prefix' => 'order', 'namespace' => 'Order', 'middleware' => 'auth:driver'], function () {
    Route::get('list', 'ListController');
    Route::get('detail', 'DetailController');
    Route::post('confirmed', 'ConfirmedController');
    Route::post('completed', 'CompletedController');
});