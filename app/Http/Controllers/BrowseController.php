<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function index(){
        return view('browse');
    }    


    public function posts()
    {   
    	$posts = Post::latest()->with('images')->paginate(8);
    	
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
}
