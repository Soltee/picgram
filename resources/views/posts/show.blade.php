@extends('layouts.app')

@section('content')

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
            
@endsection
