<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', "namespace" => "Api\V1"], function () {
    Route::post('login', "AuthController@Login");
    Route::post('register', "AuthController@Register");
    Route::post('resetpassword', "AuthController@resetPassword");

    Route::group(["middleware" => "jwt.auth"], function () {
        Route::get('me', "ProfileController@profile");
        Route::get('allposts', "ProfileController@allPosts");
        Route::match(["PUT", "PATCH"],'updateprofile', "ProfileController@updateProfile");
        Route::apiResource("posts", "PostsController");
        Route::post('logout', "ProfileController@logout");
    });
});
