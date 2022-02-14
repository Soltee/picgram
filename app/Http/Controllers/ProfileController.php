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
use Image;
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

        $profile      = $user->profile;

        $followings   = count($user->followings);
        $followers    = count($user->followers);
        $isFollowing  = (auth()->user()->isFollowing($user)) ? true : false;

        // $follows = (auth()->user()) ? auth()->user()->isFollowing($user) : false;
        // dd($isFollowing);
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

        if($request->input('type') === 'profile'){

            $data = $request->validate([
                'about' => 'nullable',
                'url'   => 'nullable|url'
            ]);


            if($request->hasFile('avatar'))
            {   
                $avatar = $user->profile->avatar;
                if(Storage::disk('public')->exists($avatar))
                {
                    Storage::disk('public')->delete( $avatar);
                } 
              
                

            
                    $image     = $request->file('avatar');
                    $basename  = Str::random();
                    $original  = 'us-' . $basename . '.' . $image->getClientOriginalExtension();

                    $img = Image::make($image->getRealPath());
                    $img->fit(160, 160, function ($constraint) {
                        $constraint->upsize();                 
                    });

                    $img->stream(); // <-- Key point

                    $path = Storage::disk('public')->put('/users/' . $original, $img, 'public');

                    $imagearray = ['avatar' => '/users/'. $original];
                    
                // } else {
                //     Cloudder::upload($request->file('avatar'), null,  
                //     [
                //         "folder" => "picgram/users/"
                //     ],  []);

                //     $c = Cloudder::getResult();
                //     $imagearray = ['avatar' => $c['url']];
                // }

            }


            auth()->user()->profile->update(array_merge($data, $imagearray ?? []));
        }

        //Change name, email and password
        if($request->input('type') === 'info')
        {
            $data = $request->validate([
                'name' => ['nullable', 'string', 'max:255'],
                'email' => ['nullable', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            auth()->user()->update([
                'name'       => $data['name'],
                'email'      => $data['email'],
                'password'   => bcrypt($data['password'])
            ]);
        }

        return back()->with('success', 'Profile updated.');


    }


}
