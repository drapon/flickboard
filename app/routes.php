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
Route::get('login/id/{email}/{password}','LoginController@login');
Route::get('login/activate/{activate}','LoginController@activate');

// Route::get('email',function(){
//  $data['name']='林龍一';
//  Mail::send('emails.test',$data,function($m){
//  $m->to('ryuichi.hayashi@gmail.com','Ryuichi Hayashi')->subject('Welcome!');
//  });
//  return 'メールを送信しました。';
// });