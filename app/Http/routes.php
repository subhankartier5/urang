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

/*Admin Routes*/
	Route::get('admin', ['uses' => 'AdminController@index', 'as' => 'get-admin-login']);
	Route::post('admin', ['uses' => 'AdminController@LoginAttempt', 'as' => 'post-admin-login']);
	Route::get('dashboard', ['uses' => 'AdminController@getDashboard', 'middleware' => 'auth', 'as' => 'get-admin-dashboard']);
	Route::get('logout', ['uses' => 'AdminController@logout', 'as' => 'get-admin-logout']);
