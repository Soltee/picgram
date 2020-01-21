@extends('layouts.app')

@section('content')
<div class="flex justify-between  px-3 py-3 md:px-16 ">

    <div class="w-full flex-1 mb-16">
      <user-profile :auth="{{ auth()->user() }}" :user="{{ $user }}"  :profile="{{ $profile }}"> </user-profile>
    </div>

    <div class="md:w-auto fixed bottom-0 left-0 w-full md:static  rounded-lg pl-3 flex flex-col items-center">
         @include('_partials.nav')
    </div>
    
</div>
 
@endsection
