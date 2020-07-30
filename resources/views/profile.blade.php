@extends('layouts.app')

@section('content')
<div class="px-6 lg:px-3 mt-8 ">

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
