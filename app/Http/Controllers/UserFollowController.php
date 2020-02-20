<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserFollowController extends Controller
{
    public function index(User $user){
        $followers    = $user->followers()->get();
        $followings   = $user->followings()->get();
        $followersId    = (count($followers) > 0) ? Arr::pluck($followers, 'id') : [];

        if(count($followersId) > 0){
            $followUsers =  User::with('profile')->findOrFail($followersId);
        }
        $followingsId  = (count($followings) > 0) ? Arr::pluck($followings, 'id') : [];
        if(count($followingsId) > 0){
            $followingUsers =  User::with('profile')->findOrFail($followingsId);
        }
        // dd($followUsers);
        return response()->json([
            'followers'      => ($followUsers)?? [],
        	'followings'     => ($followingUsers)?? []
        ], 200);
    }
}
