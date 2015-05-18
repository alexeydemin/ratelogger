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

Route::get('/', 'WelcomeController@index');

Route::get('parser', 'ParserController@index');

Route::get('about', 'AboutController@index');

Route::get('home', 'HomeController@index');

Route::get('chart', 'ParserController@chart');

Route::post('chart', 'ParserController@proceed');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
