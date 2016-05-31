<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Socialite;

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'middleware'=>'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});

Route::auth();

Route::get('/home', 'HomeController@index');


Route::resource('posts', 'PostController');

Route::get('/snsLogin', function() {
    return Socialite::with('weixin')->redirect();
});
