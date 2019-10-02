<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::resource('register', 'AuthController@register');
// Route::post('login', 'AuthController@login');
// Route::name('me')->get('users/me', 'User\UserController@me');
// Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);
// Route::name('verify')->get('users/verify/{token}', 'User\UserController@verify');
// Route::name('resend')->get('users/{user}/resend', 'User\UserController@resend');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'UserController@store');
    Route::post('update', 'UserController@update');

});