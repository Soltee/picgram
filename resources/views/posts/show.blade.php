@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto flex flex-wrap justify-center">

           
    <div class="lg:w-4/5 md:w-3/5 w-full mb-20">
        <div class="flex flex-row items-center">
            <div class="mr-3">
                @if($profile->avatar)
                    <a href="{{ route('profile', $user->id) }}">
                        <img class="user-img-sm" src="{{ url('storage/'. $profile->avatar) }}">
                    </a>
                @else
                   <svg class="user-img-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
                @endif
            </div>
            
           
            <div>
                <follow-profile user="{{ $user->id }}" follows="{{ $follows }}"></follow-profile>
            </div>
        </div>

                    
        <div class="mt-4">
             <img class="lg:w-auto w-full"  src="{{ asset('storage/'. $post->post_image ) }}">
        </div>

        <div class="flex flex-row mt-4">
            <comment-post post="{{ $post->id }}"></comment-post>
        </div>
    </div>

    <div class="lg:w-1/5 md:w-2/5 w-full lg:static md:static fixed left-0 bottom-0 lg:bg-transparent md:bg-transparent lg:p-0 md:p-0 pb-0 pt-2 bg-gray-400">
        @include('_partials.nav')
    </div>
    
</div>

            
@endsection
