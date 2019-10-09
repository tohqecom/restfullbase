<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
// Route::get('/', 'ChatController@index');
Route::get('/chat', 'ChatController@index');
Route::post('/chat', 'ChatController@send');
Route::get('/messages', 'ChatController@messages');
// dd(Auth::routes());

Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');
