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
    	// dd($user);
    	// dd(auth()->user()->following()->toggle(1));
    	$user->toggleFollow($user->profile);
    	return response()->json(['success'=>'Ok'], 200);
    }
}
