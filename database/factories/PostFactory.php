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
    	},
        'caption' => $faker->text(30)
    ];
});


$factory->define(App\PostImage::class, function (Faker $faker) {
    return [
    	'post_id' => function(){
    		$posts = Post::inRandomOrder()->pluck('id')->toArray();
    		return  Arr::random($posts);
    	},
        // 'url' =>  function(){
        //     $path =  'posts/1.jpg';
        //     if(env('APP_ENV') === 'local'){
        //         return 'http://localhost:8000/storage/' . $path;
        //     } else {
        //         return 'http://localhost:8000/' . $path;
        //     }
        // }
        'url' => $faker->imageUrl(640, 480)
        // 'http://lorempixel.com/640/480/'
    ];
});