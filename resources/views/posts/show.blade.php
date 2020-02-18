@extends('layouts.app')

@section('content')
<div class="flex justify-between  px-3 py-3 md:px-32 ">

    
    <div class="w-full flex-1 mb-16 bg-gray-800 mr-3">
       
        <browse-post :post="{{ $post }}" liked="{{ $liked }}" :user="{{$user}}" :profile="{{$profile}}" :images="{{$images}}"></browse-post>      
          {{--   <div>
                <follow-profile user="{{ $user->id }}" follows="{{ $follows }}"></follow-profile>
            </div>
        </div> --}}
           

    </div>

    <div class="md:w-auto fixed bottom-0 left-0 w-full md:static  rounded-lg flex flex-col items-center ">
        @include('_partials.nav')
    </div>
    
</div>

            
@endsection
