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

Route::get('/p/create', 'PostsController@create')->name('posts.create');
Route::post('/p', 'PostsController@store')->name('posts.store');
Route::get('/p/{post}-{slug}', 'PostsController@show')->name('posts.show');

Route::get('/p/browse', 'HomeController@browse')->name('browse');
Route::get('/c', 'HomeController@categories')->name('browse.categories');
Route::get('/p/', 'HomeController@posts')->name('browse.posts');
Route::get('/p/{category}', 'HomeController@postsByCategory')->name('browse.posts');

Route::get('/profile/{user}', 'ProfileController@index')->name('profile');
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile/{user}/update', 'ProfileController@update')->name('profile.update');

Route::post('/follow/{user}/profile', 'FollowController@store')->name('follow.profile');
Route::get('/p/{post}/comments', 'CommentController@index')->name('comment.index');
Route::post('/p/{post}/comment', 'CommentController@store')->name('comment.store');