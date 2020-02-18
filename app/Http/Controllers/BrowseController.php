<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function index(){
        return view('browse');
    }    


    public function posts()
    {   
        $paginate = request()->paginate;

    	$posts = Post::latest()->with(['user.profile', 'images'])->paginate($paginate);
    	
        return response()->json([
        	'posts' => $posts->items(),
        	'paginate' => [
                'first_item'    => $posts->firstItem(),
                'last_item'     => $posts->lastItem(),
                'previous_page_url' => $posts->previousPageUrl(),
                'current_page'      => $posts->currentPage(),
                'next_page_url'     => $posts->nextPageUrl(),
                'current_count' => $posts->count(),
                'total_count'   => $posts->total()
            ]
        ], 200);
    }


    public function show(Post $post)
    {
        $user = $post->user;
        $liked = (auth()->user()->hasLiked($post)) ? true : false;
        $profile = $user->profile;
        $images = $post->images;
        // dd($liked);

        return view('posts.show', compact('post', 'liked', 'user', 'profile', 'images'));
        // return response()->json([
        //     'post' => $post,
        //     'user' => $user,
        //     'images' => $images
        // ], 200);
    }
}
