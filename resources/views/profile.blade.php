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

    <div class="md:w-auto fixed bottom-0 left-0 w-full md:static  rounded-lg pl-3 flex flex-col items-center">
         @include('_partials.nav')
    </div>
    
</div>
 
@endsection
