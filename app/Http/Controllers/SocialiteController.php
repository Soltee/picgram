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
    	if($user->getEmail()){
    		$this->validate($request, [
    			'name' => 'required|string|min:4|unique:users',
	            'email' => 'required|email|min:4|unique:users'
    		]);
    	}

    	$newUser =  User::create([
            'name' => ($user->getName())?? $faker->name,
            'email' => ($user->getEmail())?? $faker->unique()->safeEmail,
            'email_verified_at' => now(),
    		'remember_token' => Str::random(10),
            'password' => bcrypt(md5(rand(1,10000)))
        ]);

        Profile::create([
        	'user_id'  => $newUser->id,
        	'avatar'    => ($user->getAvatar())?? '',
        ]);

        // dd($newUser->id);

        $social = new Social([
			'user_id' => $newUser->id,
            'token' => $user->token,
            'provider_id' => $user->getId(),
            'provider' => 'facebook',
            'expires_on' => $user->expiresIn
        ]);

        Auth::login($newUser);
  
        return redirect('/home')->with('toast_success', 'You are logged in.');
    }

   
}
