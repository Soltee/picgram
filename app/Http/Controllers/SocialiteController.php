<?php

namespace App\Http\Controllers;

use App\User;
use Socialite;
use App\Social;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function callback(Request $request, Faker $faker)
    {	
    	$user = Socialite::driver('facebook')->user();
        
        // dd($user);
        $userEmail = '';
    	if($user->getEmail()){

            $foundUser = User::where('email', $user->getEmail())->first();
            $userEmail = $user->getEmail();

    	} elseif($user->getId()) {

            $foundUser = User::where('email', $user->getId() .'@mail.com')->first();  
            $userEmail = $user->getId()  . '@mail.com';

        } else {

            return back()->with('toast_error', 'Sorry.Your facebook email is not found.');
            
        }


        if($foundUser){

            Auth::login($foundUser);

        } else {

            $newUser =  User::create([
                'name'                => ($user->getName())?? $faker->name,
                'email'               => $userEmail,
                'remember_token'      => Str::random(10),
                'password'            => bcrypt(Str::random(12))
            ]);
            $newUser->markEmailAsVerified();

            // dd($newUser);

            Profile::create([
                'user_id'   => $newUser->id,
                'avatar'    => ($user->getAvatar()) ?? '',
            ]);

            // dd($newUser->id);

            $social = new Social([
                'user_id'       => $newUser->id,
                'token'         => $user->token,
                'provider_id'   => $user->getId(),
                'provider'      => 'facebook',
                'expires_on'    => $user->expiresIn
            ]);

            Auth::login($newUser);
        }

        return redirect('/home')->with('toast_success', 'You are logged in.');

    }

   
}
