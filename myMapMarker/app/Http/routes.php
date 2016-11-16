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



Route::get('home', 'HomeController@index');

Route::get('welcome', 'WelcomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::get('auth/login', 'Auth\AuthController@getLogin');

Route::post('auth/login', 'Auth\AuthController@postLogin');

//User
Route::group(['prefix' => 'user','namespace' => 'User','middlware'=>'auth'],function(){
    Route::get('/{id}/maps','UserController@getMapsByUser');
    Route::get('/maps','UserController@getMapsForAuthUser');

});




Route::group(['prefix' => 'map','namespace' => 'Map','middlware'=>'auth'],function(){
    Route::get('/','MapController@index');
    Route::get('/create','MapController@create');
    Route::post('/create','MapController@store');
    Route::get('/edit/{id}','MapController@edit');
    Route::get('/{id}','MapController@showMap');
    Route::get('/user/{userId}','MapController@getMapsByUserId');

});


