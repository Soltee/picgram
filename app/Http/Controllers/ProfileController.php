<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $posts = $user->posts()->latest()->paginate(10);
        $user = $user;
        $profile = $user->profile;
        $following = $user->following;
        $followers = $user->profile->followers;

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        
        return view('profile', compact('posts', 'user', 'profile', 'following', 'followers', 'follows'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
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
        $this->authorize('update', $user->profile);

        $data = $request->validate([
            'avatar' => '',
            'caption' => 'required|string',
            'about' => 'required',
            'url' => 'url'
        ]);


        if($request->hasFile('avatar'))
        {
            Cloudder::upload($request->file('avatar'), null,  
            [
                "folder" => "picgram/users/"
            ],  []);

            $c = Cloudder::getResult();
            

            $imagearray = ['avatar' => $c['url']];
        }

        auth()->user()->profile->update(array_merge($data, $imagearray ?? []));

        return redirect('profile/' . $user->id)->with('success', 'Profile updated.');

    }


}
