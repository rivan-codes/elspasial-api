<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController');
    Route::post('register', 'RegisterController');

    Route::group(['middleware' => 'auth:user'], function () {
        Route::get('profile', 'ProfileController');
        Route::post('profile/update', 'ProfileUpdateController');
        Route::post('logout', 'LogoutController');
        Route::post('change_password', 'ChangePasswordController');
    });
});

// Route::group(['prefix' => 'home', 'namespace' => 'Home', 'middleware' => 'auth:user'], function () {
//     Route::get('/', 'IndexController');
// });