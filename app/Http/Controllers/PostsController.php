<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
        $categories = Category::latest()->get();
        return view('posts.create', compact('categories'));
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
            'category' => 'required|int',
            'file' => 'required|image',
            'caption' => 'string|min:4',
        ]);

        $imagePath = $request->file('file')->store('posts', 'public');

        $storeImage = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $storeImage->save();

        auth()->user()->posts()->create([
            'category_id' => $data['category'],
            'caption' => $data['caption'],
            'post_image' => $imagePath
        ]);

        return redirect()->route('home')->with('success', 'Post uploaded.');
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
