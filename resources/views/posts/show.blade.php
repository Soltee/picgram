@extends('layouts.app')

@section('content')
<div class="flex justify-between  px-3 py-3 md:px-32 ">

    
    <div class="w-full flex-1 mb-24  mr-3">
  
        <browse-post
            :auth="{{ Auth::user() }}" 
            hasfollowed="{{ $isFollowing }}"
            :post="{{ $post }}" 
            liked="{{ $liked }}" 
            likedCount="{{ $likedtotal }}" 
            :user="{{$user}}" 
            :profile="{{$profile}}" 
            :images="{{$images}}">
                
        </browse-post>        

    </div>


    
</div>

            
@endsection
