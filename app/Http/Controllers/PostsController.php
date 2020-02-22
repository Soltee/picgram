<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Auth;
use App\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use JD\Cloudder\Facades\Cloudder;
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
            'files.*' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
            'caption' => 'string|min:4',
        ]); 
            
        // dd($data);
        $images      = $request->file('files');
         // get the validated filee
        foreach ($images as $image) {
            if(env('APP_ENV') === 'local'){

                $basename  = Str::random();
                $original  = 'p-' . $basename . '.' . $image->getClientOriginalExtension();

                $img = Image::make($image->getRealPath());
                $img->fit(600, 600, function ($constraint) {
                    $constraint->upsize();                 
                });

                $img->stream(); // <-- Key point

                Storage::disk('public')->put('/posts/' . $original, $img, 'public');
                $paths[] = env('APP_URL') . '/storage/posts/' . $original;
            } else {

                Cloudder::upload($image, null,  
                [
                    "folder" => "picgram/posts/"
                ],  []);

                $c = Cloudder::getResult();
                $paths[] = $c['url'];
            }

        }

        
        $post = auth()->user()->posts()->create([
            'caption' => $data['caption']
        ]);

        foreach ($paths as $path) {
            // dd($path);
           
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
        $post->delete();
        foreach ($post->images as $image) {
            $image->delete();
            ($image->url) ?? Storage::disk('public')->delete($image->url);            
        }
        return response()->json(['success' => 'Ok!'], 204);
    }
}
