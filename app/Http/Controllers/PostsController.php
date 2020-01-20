<?php

namespace App\Http\Controllers;

use App\Post;
use Auth;
use App\PostImage;
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
        

    public function index(){
        
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
            'file*' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
            'caption' => 'string|min:4',
        ]); 
            
        $images      = $request->file('files'); // get the validated filee
        foreach ($images as $image) {
            $basename  = Str::random();
            $original  = 'pd-' . $basename . '.' . $image->getClientOriginalExtension();
            $paths[] = $image->storeAs('posts', $original, 'public'); 
        }

        $post = auth()->user()->posts()->create([
            'caption' => $data['caption']
        ]);

        foreach ($paths as $path) {
            PostImage::create([
                'post_id' => $post->id,
                'url'   => $path,
            ]);
        }
        
        return response()->json(['success' => 'Ok'], 201);
        // Cloudder::upload($request->file('file'), null,  
        //     [
        //         "folder" => "picgram/posts/"
        //     ],  []);

        // $c = Cloudder::getResult();

        // auth()->user()->posts()->create([
        //     'caption' => $data['caption'],
        //     'post_image' => $c['url']
        // ]);

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
