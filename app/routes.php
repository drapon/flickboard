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

Route::get('/', function()
{
	return View::make('hello');
});
Route::get('sentry/user',function(){
    $user=Sentry::getUserProvider()->findAll();
    return var_dump($user);
});
//ユーザー登録
Route::get('login/adduser/{email}/{password}','LoginController@adduser');
//ログイン
Route::get('login/login/{email}/{password}','LoginController@login');