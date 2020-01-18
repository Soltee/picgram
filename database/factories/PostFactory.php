<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Post::class, function (Faker $faker) {
    return [
    	'user_id' => function(){
    		$users = User::inRandomOrder()->pluck('id')->toArray();
    		return  Arr::random($users);
    	}
    ];
});


$factory->define(App\PostImage::class, function (Faker $faker) {
    return [
    	'post_id' => function(){
    		$posts = Post::inRandomOrder()->pluck('id')->toArray();
    		return  Arr::random($posts);
    	},
    	'url'  => function(){
    		foreach ([1,2,3,4,5,6,7,8,9,10, 11] as $n) {
                return '/posts/' . $n . ".jpg";
            }
    	}
    ];
});