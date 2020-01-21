<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Str;
use App\Post;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, $slug)
    {
        // dd($user);
        // $user = User::findOrfail($user);
        $profile = $user->profile;
        $followings = $user->followings()->get();
        $followers = $user->followers()->get();
        $isFollowing = auth()->user()->isFollowing($user);

        // $follows = (auth()->user()) ? auth()->user()->isFollowedBy($user) : false;
        // dd(auth()->user()->posts());
        return view('profile', compact('user', 'profile', 'isFollowing', 'followings', 'followers'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // dd($user);
        $this->authorize('update', $user->profile);
        $profile = $user->profile;
        return view('uprofile', compact('user', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // if(env('APP_ENV') === 'local'){
        //             dd(env('APP_ENV'));
        // }
        $this->authorize('update', $user->profile);

        if($request->input('type') === 'profile'){

            $data = $request->validate([
                'name' => '',
                'caption' => 'required|string',
                'about' => 'required',
                'url' => 'url'
            ]);


            if($request->hasFile('avatar'))
            {
                if(file_exists(public_path() . '/storage/' . $user->profile->avatar)){
                    Storage::disk('public')->delete($user->profile->avatar);
                }

                if(env('APP_ENV') === 'local'){
                    $image     = $request->file('avatar');
                    $basename  = Str::random();
                    $original  = 'us-' . $basename . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('users', $original, 'public'); 

                    $imagearray = ['avatar' => $path];
                } else {
                    Cloudder::upload($request->file('avatar'), null,  
                    [
                        "folder" => "picgram/users/"
                    ],  []);

                    $c = Cloudder::getResult();
                    $imagearray = ['avatar' => $c['url']];
                }

            }


            auth()->user()->profile->update(array_merge($data, $imagearray ?? []));
        }

        if($request->input('type') === 'info'){
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            auth()->user()->update($data);
       }

        return redirect('profile/' . $user->id . '/' . $user->name)->with('toast_success', 'Profile updated.');

    }


}
