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
    Route::get('getUserInfo', 'AuthAPIController@getUserInfo');
    Route::get('logout', 'AuthController@logout');
});


// Auth
Route::any('login', 'AuthController@login');
// Route::post('refresh', 'AuthAPIController@refreshToken');
Route::resource('posts', 'PostAPIController');
