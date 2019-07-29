<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {

        $comments = Comment::where('post_id', $post->id)->with('user.profile')->latest()->get();
            
        return response()->json([
            'comments' => $comments
        ], 200);
    
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
    
        $request->validate([
            'comment' => ['string']
        ]);

        $comment = auth()->user()->comments()->create([
            'post_id' => $post->id,
            'comment' => request('comment')
        ]);

       return  response()->json(['comment' => $comment  ], 201);
    }

}
