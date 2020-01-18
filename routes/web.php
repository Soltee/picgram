<?php


Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('/validateData', 'ValidationController@index');

Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/redirect', 'SocialiteController@redirect');
Route::get('/callback', 'SocialiteController@callback');

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');
Route::get('/u/p', 'HomeController@postByF');

Route::get('/p/create', 'PostsController@create')->name('posts.create');
Route::post('/p', 'PostsController@store')->name('posts.store');
Route::get('/p/{post}-{slug}', 'PostsController@show')->name('posts.show');

Route::get('/browse', 'BrowseController@index')->name('browse');
Route::get('/posts', 'BrowseController@posts');


Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile/{user}/update', 'ProfileController@update')->name('profile.update');

Route::post('/follow/{user}/profile', 'FollowController@store')->name('follow.profile');
Route::get('/p/{post}/comments', 'CommentController@index')->name('comment.index');
Route::post('/p/{post}/comment', 'CommentController@store')->name('comment.store');

Route::get('/search', 'HomeController@search')->name('search.users');