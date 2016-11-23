<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/facebook', 'Auth\RegisterController@getFacebook');
Route::get('/facebook-callback', 'Auth\RegisterController@getFacebookCallback');
Route::get('/twitter', 'Auth\RegisterController@getTwitter');
Route::get('/twitter-callback', 'Auth\RegisterController@getTwitterCallback');
Route::get('/google', 'Auth\RegisterController@getGoogle');
Route::get('/google-callback', 'Auth\RegisterController@getGoogleCallback');
Route::get('/goodreads', 'Auth\RegisterController@getGoodreads');
Route::get('/goodreads-callback', 'Auth\RegisterController@getGoodreadsCallback');