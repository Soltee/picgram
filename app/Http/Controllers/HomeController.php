<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Comment;
use App\User;


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
     * Home View
    **/
    public function home(){ 
        // $users = auth()->user()->following->pluck('user_id');
        // $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(1);
        // dd($posts);
        return view('home'); }

    public function postByF()
    {
        $users = auth()->user()->following->pluck('user_id');
        if(count($users) > 0){
            $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(1);
            return response()->json(['posts' => $posts], 200);       
        } else {
            return response()->json(['posts' => []], 200); 
        }
        // $posts = ($users) ? Post::whereIn('user_id', '$users')->with('user')->latest()->paginate(1) : [] ;

    }

    /**
     * Search users
    **/

    public function search()
    {   
        // $users = User::search($request->input('key'), null, true)->with('posts')->paginate(20);
        $users = User::where('name', 'LIKE', '%'. request('name') .'%')->with('posts', 'profile')->paginate(20);
        return response()->json(['users' => $users], 200);
    }

    /**
     * Browse all posts
    **/

    public function browse()
    {   
        return view('browse');
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
