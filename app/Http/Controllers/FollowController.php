<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;

class FollowController extends Controller
{
	public function __constuct()
	{
		$this->middleware('auth');
	}
	
    public function store(User $user)
    {
    	auth()->user()->toggleFollow($user);
    	return response()->json(['success'=>'Ok'], 200);
    }
}
