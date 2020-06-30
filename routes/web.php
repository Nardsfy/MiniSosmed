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

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/user/{id}', 'HomeController@user');

Route::middleware(['guest'])->group(function() {
Route::get('/', 'UserController@login')->name('signin');
Route::get('/signup', 'UserController@register')->name('signup');
});

Route::post('/status', 'HomeController@status')->name('status');
Route::post('/addfriend/{id}', 'HomeController@addFriend');
Route::get('/deletefriend/{id}', 'HomeController@deleteFriend');
Route::post('/addkomen/{id}/{user}', 'HomeController@addKomen');
Route::post('/updatedata', 'HomeController@updateData');
Route::get('/cari', 'HomeController@cari');
Route::get('/addlikes/{id}', 'HomeController@addLikes');
Route::get('/deletelikes/{id}/{id2}', 'HomeController@deleteLikes');
Route::get('/deletestatus/{id}', 'HomeController@deleteStatus');
Route::post('/updateprofile', 'HomeController@updateprofile');

Auth::routes();
