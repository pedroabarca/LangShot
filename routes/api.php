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
//story
Route::delete('story/{id}',[
    'uses'=> 'StoryController@destroy',
    'middleware' => 'jwt_auth'
]);

Route::get('story/{id}',[
    'uses'=> 'StoryController@show',
    'middleware' => 'jwt_auth'
]);

Route::post('story',[
    'uses'=> 'StoryController@store',
    'middleware' => 'jwt_auth'
]);

Route::get('story',[
    'uses'=> 'StoryController@index',
    'middleware' => 'jwt_auth'
]);

//comment
Route::post('comment',[
    'uses'=> 'CommentController@store',
    'middleware' => 'jwt_auth'
]);

Route::patch('comment/{id}',[
    'uses'=> 'CommentController@update',
    'middleware' => 'jwt_auth'
]);

//user
Route::post('user',[
    'uses'=> 'UserController@signUp'
]);

Route::post('user/signin',[
    'uses'=> 'UserController@signIn'
]);
route::get('users',[
   'uses'=> 'UserController@index',
    'middleware' => 'jwt_auth'
]);
Route::get('user/{user_name}',[
    'uses'=> 'UserController@show',
    'middleware' => 'jwt_auth'
]);
Route::patch('user/{id}',[
    'uses'=> 'UserController@update',
    'middleware' => 'jwt_auth'
]);
