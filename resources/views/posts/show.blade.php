@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-row">
        
        <div class="col-md-2">
            @include('_partials.nav')
        </div>


        <div class="col-md-10">
            
            <div class="">
                <div class="d-flex flex-row align-center">
                    <div class="mr-3">
                        @if($profile->avatar)
                            <img class="user-img-sm" src="{{ url('storage/'. $profile->avatar) }}">
                        @else
                           <svg class="user-img-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
                        @endif
                    </div>
                    <div>
                        <follow-profile user="{{ $user->id }}" follows="{{ $follows }}"></follow-profile>
                    </div>
                </div>

                    
                <div class="mt-4">
                     <img class="single_post_image"  src="{{ asset('storage/'. $post->post_image ) }}">
                </div>

                <div class="d-flex flex-row mt-4">
                    <comment-post post="{{ $post->id }}"></comment-post>
                </div>


                

            </div>   
            
        </div>
        <!--- End of Right Col -->
    </div>
</div>
@endsection
