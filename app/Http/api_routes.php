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
    Route::get('user_info', 'AuthController@getUserInfo');
    Route::get('logout', 'AuthController@logout');
});


// Auth
Route::get('login', 'AuthController@login');
Route::get('refresh_token', 'AuthController@refreshToken');
// Route::post('refresh', 'AuthAPIController@refreshToken');
Route::resource('posts', 'PostAPIController');
