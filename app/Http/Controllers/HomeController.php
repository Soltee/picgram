<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Comment;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $posts = auth()->user()->posts()->latest()->paginate(10);;
        return view('home', compact('posts'));
    }

    /**

     * Browse all posts

    **/

    public function browse($category="")
    {   
        if($category){
            dd($category);
        }
        $categories = Category::latest()->get();
        $posts = Post::latest()->paginate(10);
        
        return view('browse', compact('categories', 'posts'));
    }


    /**

     * Get all categories

    **/

    public function categories()
    {   

        $categories = Category::latest()->get();
        
        return response()->json(['categories' => $categories], 200);
    }

    /**
     * Get all posts
    **/

    public function posts()
    {   
        return response()->json(['posts' => Post::latest()->paginate(2)], 200);
    }

     /**
     * Get all posts by category
    **/

    public function postsByCategory(Category $category)
    {   
        return response()->json(['posts' => Post::where('category_id', $category->id)->latest()->paginate(1)], 200);
    }
}
