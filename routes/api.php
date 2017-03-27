<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('user',[
    'uses'=> 'UserController@signUp'
]);

Route::post('user/signin',[
    'uses'=> 'UserController@signIn'
]);
route::get('users',[
   'uses'=> 'UserController@index'
]);
route::get('user/{id}',[
    'uses'=> 'UserController@show'
]);
route::patch('user/{id}',[
    'uses'=> 'UserController@update'
]);
