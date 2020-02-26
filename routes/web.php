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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get-posts', 'PostController@getPost')->name('get-posts');
Route::get('/get-posts-data', 'PostController@getPostData')->name('get-posts-data');

Route::resource('posts', 'PostController');
