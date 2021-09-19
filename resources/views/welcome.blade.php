@extends('layouts.app')

@section('head')
	<style>
		.hero{clip-path: polygon(0 0, 84% 0, 70% 100%, 0% 100%);;}
	</style>
@endsection
@section('authentication')

<div class="flex items-center justify-center min-h-screen">
	 <div class="hero hidden md:block md:w-1/2 min-h-screen overflow-hidden  bg-gray-800  z-20"  style="background: url('/img/bk.jpg'); background-size: cover; background-position: center center;">
	 	
	 </div>
	     
	<welcome-view :errors="{{ $errors }}"></welcome-view>
</div>
  
@endsection
