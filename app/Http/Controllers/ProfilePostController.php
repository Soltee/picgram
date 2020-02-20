<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfilePostController extends Controller
{
    public function index(User $user){
    	$paginate = request()->paginate;

    	$posts = $user->posts->latest()->with(['user.profile', 'images'])->paginate($paginate);
    	
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
