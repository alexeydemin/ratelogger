<?php

Route::get('/', 'ParserController@proceed');
Route::get('/json', 'ParserController@get_data');
//Route::get('/en', function(){ tinkoff::setLocale('en');} );

