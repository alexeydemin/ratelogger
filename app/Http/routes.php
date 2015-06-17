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

/*interface BarInterface{}

class Bar implements BarInterface{}

App::bind('BarInterface', function()
{
    return new Bar;
});

Route::get('bar', function(BarInterface $bar){

    dd($bar);
});

Route::get('/', 'WelcomeController@index');

Route::post('/', 'WelcomeController@index');

Route::get('parser', 'ParserController@index');

Route::get('about', 'AboutController@create');

Route::post('about', 'AboutController@keep');

Route::get('home', 'HomeController@index');*/

Route::get('/', 'ParserController@proceed');
Route::post('/', 'ParserController@proceed');
Route::get('/json', 'ParserController@get_data');
//Route::post('/json', 'ParserController@get_data');

/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/
