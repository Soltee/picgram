@extends('layouts.app')

@section('content')
<div class="">

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
