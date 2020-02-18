<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    

    public function store(Post $post)
    {
        $user = auth()->user();
        $user->toggleLike($post);
        return response()->json(['success'=>'Ok'], 200);
    }


}
