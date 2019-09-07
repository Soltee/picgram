<?php

use Illuminate\Http\Request;

Route::middleware('web')->get('/posts_browse', 'HomeController@posts')->name('browse.posts');
