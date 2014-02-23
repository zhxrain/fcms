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

Route::get('/', 'HomeController@showHomepage');
// Confide RESTful route
Route::get('user/login', 'UserController@login');
Route::post('user/login', 'UserController@postLogin');
Route::get('user/confirm/{code}', 'UserController@getConfirm');
Route::get('user/reset/{token}', 'UserController@getReset');

// Role RESTful route
Route::controller( 'role', 'RoleController');

//Get submenu
Route::get('submenu/{menuitem_id}', 'HomeController@showSubmenu');

Route::get('user', 'UserController@index');
Route::get('user/{id}', 'UserController@show');
Route::put('user/{id}', 'UserController@update');
Route::post('user', 'UserController@create');
Route::delete('user/{id}', 'UserController@destroy');
