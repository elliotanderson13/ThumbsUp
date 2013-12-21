<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/profile', 'HomeController@profile');
Route::get('/wall', 'HomeController@index');
Route::get('/login', 'HomeController@login');
Route::get('/register','HomeController@register');
Route::post('/register','HomeController@handleRegister');
Route::post('/login', 'HomeController@handleLogin');
Route::get('/logout', 'HomeController@logout');
Route::get('/settings', 'AccountController@settings');
Route::post('post', 'ViewController@handlePost');
Route::get('/home', 'HomeController@index');
Route::post('/pic', 'AccountController@handlePic');
