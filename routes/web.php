<?php


Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');


Auth::routes();
          
//Authenticated Section
Route::group(['middleware' =>  'auth'], function(){

	Route::get('/home', 'HomeController@home')->name('home');
	Route::get('/u/p', 'HomeController@postByF');

	Route::get('/p/create', 'PostsController@create')->name('posts.create');
	Route::post('/p', 'PostsController@store')->name('posts.store');
	Route::get('/p/{post}-{slug}', 'PostsController@show')->name('posts.show');
	Route::delete('/p/{post}/delete', 'PostsController@destroy')->middleware('auth');

	Route::get('/browse', 'BrowseController@index')->name('browse')->middleware('auth');
	Route::get('/browse/posts', 'BrowseController@posts')->middleware('auth');
	Route::get('/posts/{post}/{caption}', 'BrowseController@show')->middleware('auth');

	/*Like*/
	Route::post('/like/{post}', 'LikeController@store')->middleware('auth');

	//Profile
	Route::get('/profile/{user}/{slug}', 'ProfileController@index')->name('profile');
	Route::get('/edit/{user}', 'ProfileController@edit')->name('profile.edit');
	Route::patch('/profile/{user}/update', 'ProfileController@update')->name('profile.update');
	Route::get('/posts/{user}', 'PostsController@index');

	//Follow & Unfollow
	Route::get('/userFollow/{user}', 'UserFollowController@index');

	Route::post('/follow/{user}', 'FollowController@store')->name('follow.profile');

	//Comments
	Route::get('/p/{post}/comments', 'CommentController@index')->name('comment.index');
	Route::post('/p/{post}/comment', 'CommentController@store')->name('comment.store');

	Route::get('/search', 'HomeController@search')->name('search.users');
	
});

