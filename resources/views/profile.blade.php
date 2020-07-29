@extends('layouts.app')

@section('content')
<div class="flex justify-between  px-3 py-3 md:px-48 lg:px-64 ">

    <user-profile 
  		:auth="{{ auth()->user() }}" 
        hasfollowed="{{ $isFollowing }}"
  		:user="{{ $user }}"  
  		:profile="{{ $profile }}"
  		followers="{{ $followers }}"
  		followings="{{ $followings }}"
  		> 
  	</user-profile>

    
</div>
 
@endsection
