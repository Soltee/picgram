<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function index(){
        // $posts = Post::latest()->with(['user.profile', 'images'])->paginate(10);
        return view('browse');
    }    


    public function posts()
    {   
        $paginate = request()->paginate;

    	$posts = Post::latest()->with(['user.profile', 'images'])->paginate($paginate);
    	
        return response()->json([
        	'posts' => $posts->items(),
        	'paginate' => [
                'next_page_url'     => $posts->nextPageUrl(),
                'last_page' => $posts->hasPages(),
                'total_count'   => $posts->total()
            ]
        ], 200);
    }


    public function show(Post $post)
    {
        $user = $post->user;
        $liked = (auth()->user()->hasLiked($post)) ? true : false;
        $likedtotal = count($post->likers()->get());
        $profile = $user->profile;
        $images = $post->images;
        $isFollowing  = (auth()->user()->isFollowing($user)) ? true : false;
        // dd($isFollowing);

        return view('posts.show', compact('post', 'liked', 'likedtotal', 'user', 'profile', 'images', 'isFollowing'));
        // return response()->json([
        //     'post' => $post,
        //     'user' => $user,
        //     'images' => $images
        // ], 200);
    }
}
