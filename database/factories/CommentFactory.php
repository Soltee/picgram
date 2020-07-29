<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Post;
use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => function(){
    		$users_id = User::inRandomOrder()->pluck('id')->toArray();
    		return  Arr::random($users_id);
    	}, 
        'post_id' => function(){
    		$posts = Post::inRandomOrder()->pluck('id')->toArray();
    		return  Arr::random($posts);
    	}, 
        'comment' => $faker->text(80)
    ];
});
