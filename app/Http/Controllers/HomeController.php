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
    public function home()
    { 
        return view('home'); 
    }

    /**
        * Home Posts By following only
    **/
    public function postByF()
    {
        $users = auth()->user()->following->pluck('user_id');
        if(count($users) > 0){
            $posts = Post::whereIn('user_id', $users)->with('user.profile')->latest()->paginate(2);
            return response()->json(['posts' => $posts], 200);       
        } else {
            return response()->json(['posts' => []], 200); 
        }

    }

    /**
     * Search users
    **/

    public function search()
    {   
        $query = request("term");
        $users = User::where("name", "LIKE", $query . "%")->with("posts", "profile")->get();

        return response()->json(["users" => $users], 200);
    }

    /**
     * Browse all posts
    **/

    public function browse()
    {   

        return view('browse');
    }


    /**
     * Get all posts
    **/

    public function posts()
    {   
        return response()->json(['posts' => Post::latest()->paginate(2)], 200);
    }


}
