<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', "namespace" => "Api\V1"], function () {
    Route::post('login', "AuthController@Login");
    Route::post('register', "AuthController@Register");

    Route::group(["middleware" => "jwt.auth"], function () {
        Route::get('me', "ProfileController@profile");
        Route::get('posts', "ProfileController@posts");
        Route::post('logout', "ProfileController@logout");
    });
});
