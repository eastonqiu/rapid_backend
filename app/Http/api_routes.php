<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/




Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user_info', 'AuthAPIController@getUserInfo');
    Route::get('logout', 'AuthAPIController@logout');
});


// Auth
Route::get('login', 'AuthAPIController@login');
Route::get('refresh_token', 'AuthAPIController@refreshToken');

// modules
Route::resource('posts', 'PostAPIController');
