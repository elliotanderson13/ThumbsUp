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
Route::get('/register','HomeController@register');
Route::post('/register','HomeController@handleRegister');
Route::post('/login', 'HomeController@handleLogin');
Route::get('/login', 'HomeController@login');

Route::group(array('before'=>'auth'), function()
{
	Route::get('/', 'HomeController@index');
Route::get('/profile', 'HomeController@profile');
Route::get('/wall', 'HomeController@index');
Route::get('/logout', 'HomeController@logout');
Route::get('/settings', 'AccountController@settings');
Route::post('post', 'ViewController@handlePost');
Route::get('/home', 'HomeController@index');
Route::post('/pic', 'AccountController@handlePic');
Route::get('/edit', 'AccountController@editProfile');
Route::post('/edit', 'AccountController@handleEdit');
Route::get('/thumb', 'ThumbController@index');
Route::post('/thumb', 'ThumbController@handle');
Route::get('/tag/{tag_name}', 'ThumbController@tags');

});

