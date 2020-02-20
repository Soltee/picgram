<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


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

        $followings   = auth()->user()->followings()->get();
        $followingsIds = Arr::pluck($followings, 'id');
        $followers    = auth()->user()->followers()->get();
        $followersIds = Arr::pluck($followers, 'id');

        $userIds = array_merge($followingsIds, $followersIds);

        $posts = Post::whereIn('user_id', $userIds)->with(['images', 'user.profile'])->latest()->paginate(1);
        // dd($posts);
        return response()->json([
                'posts'    => $posts->items(),
                'paginate' => [
                    'previous_page_url' => $posts->previousPageUrl(),
                    'current_page'      => $posts->currentPage(),
                    'next_page_url'     => $posts->nextPageUrl(),
                    'current_count' => $posts->count(),
                    'total_count'   => $posts->total()
                ]
            ], 200);       
      

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
    


}
