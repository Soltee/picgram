<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Auth;
use App\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;

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
        

    public function index(User $user){
        $paginate = request()->paginate;

        $posts = Post::latest()->with('images')->where('user_id', $user->id)->paginate($paginate);
        
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
            'files' => 'required',
            'files.*' => 'required|mimes:jpg,jpeg,png|max:2048',
            'caption' => 'string|min:4',
        ]); 
            
        $images      = $request->file('files');
        // if($images){
        //     $allowedfileExtension = ['jpeg','jpg','png','gif'];
        //     foreach($images as $file){
        //         $filename = $file->getClientOriginalName();

        //         $extension = $file->getClientOriginalExtension();

        //         $check = in_array($extension, $allowedfileExtension);
        //         abort_if(!$check, 422);
        //     }
        // }

         // get the validated filee
        foreach ($images as $image) {

            $basename  = Str::random();
            $original  = 'p-' . $basename . '.' . $image->getClientOriginalExtension();

            $original   = 'md-' . 
                        Str::random() . '.' . $image->getClientOriginalExtension();

            $image->move(storage_path('app/public/posts'), $original);
    
            $paths[] = env('APP_URL') . '/storage/posts/' . $original;
            
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

    public function destroy(Post $post){
        foreach ($post->images as $image) {
            $url = str_replace('http://localhost:8000/', '', $image->url);
            unlink($url);
        }
        
        $post->delete();

        return response()->json(['success' => 'Ok!'], 204);
    }
}
