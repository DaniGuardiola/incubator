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

View::addExtension('js', 'php');

Route::get('movimientos', 'HomeController@index');

Route::get('home', function () {
	return Redirect::to('movimientos');
});

Route::get('/', function () {
	return Redirect::to('movimientos');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'movimientos' => 'HomeController',
]);
