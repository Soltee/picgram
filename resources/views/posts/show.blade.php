@extends('layouts.app')

@section('content')
<div class="lg:px-3  px-6 py-3 mt-8">

    
    <div class="w-full ">
  
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
