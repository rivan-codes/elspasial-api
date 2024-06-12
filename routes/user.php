<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController');
    Route::post('register', 'RegisterController');

    Route::group(['middleware' => 'auth:user'], function () {
        Route::get('profile', 'ProfileController');
        Route::post('logout', 'LogoutController');
    });
});

Route::group(['prefix' => 'trip', 'namespace' => 'Trip', 'middleware' => 'auth:user'], function () {
    Route::get('list', 'ListController');
    Route::get('detail', 'DetailController');
});