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
Route::get('usersList','UsersController@getUsersList');
Route::get('usersList/{user}/userProfile','UsersController@getUserProfile');
Route::post('usersList/{user}/follow','UsersController@theFollowing');


Route::get('updateProfile','UsersController@getUpdateProfile');
Route::get('updateProfile/addresses','UsersController@getAddresses');
Route::post('geoLocation','UsersController@saveGeoLocation');
Route::get('updateProfile/addressesList','UsersController@getAddressesList');
Route::get('updateProfile/addresses/{location}/edit','UsersController@getAddressesEdit');
Route::post('updateProfile/addresses/{location}/update','UsersController@updateGeoLocation');
Route::delete('updateProfile/addresses/{location}/delete','UsersController@deleteGeoLocation');

Route::get('booksList',"BooksController@getBooksList");
Route::get('booksList/{book}/add',"BooksController@getBook");
Route::post('booksList/{book}/add',"BooksController@addBook");
Route::delete('booksList/{book}/delete',"BooksController@deleteBook");
Route::get('matchMaking',"BooksController@comparingBooks");


Route::get('usersList/{auther}/autherProfile',"AuthersController@getAutherProfile");
Route::post('usersList/{auther}/autherFollowing',"AuthersController@autherFollowing");

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
