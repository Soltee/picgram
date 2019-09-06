<?php

namespace App\Http\Controllers;

use App\Post;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use JD\Cloudder\Facades\Cloudder;

class PostsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'file' => 'required|image|max:2240',
            'caption' => 'string|min:4',
        ]); 
       
        Cloudder::upload($request->file('file'), null,  
            [
                "folder" => "picgram/posts/"
            ],  []);

        $c = Cloudder::getResult();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'post_image' => $c['url']
        ]);

        return redirect()->route('browse')->with('success', 'Post uploaded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $slug)
    {
        $user = $post->user;
        $profile = $post->user->profile;
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        return view('posts.show', compact('post', 'profile', 'user', 'follows'));
    }


}
