@extends('layouts.app')

@section('content')

<div class=" h-screen w-full flex md:flex-row justify-between items-center overflow-hidden">

    <div class="flex-1 h-full flex flex-col items-center justify-center hidden md:block">

    	<div class="flex flex-wrap">
    		<img src="{{ asset('img/1.jpg') }}" class="w-1/3 rounded-none" style="height: calc(100% / 2);">
    		<img src="{{ asset('img/3.jpg') }}" class="w-1/3 rounded-none" style="height: calc(100% / 2);">
    		<img src="{{ asset('img/2.jpg') }}" class="w-1/3 rounded-none" style="height: calc(100% / 2);">
    		<img src="{{ asset('img/5.jpg') }}" class="w-1/3 rounded-none" style="height: calc(100% / 2);">
    		<img src="{{ asset('img/4.jpg') }}" class="w-1/3 rounded-none" style="height: calc(100% / 2);">
    		<img src="{{ asset('img/6.jpg') }}" class="w-1/3 rounded-none" style="height: calc(100% / 2);">
            <img src="{{ asset('img/3.jpg') }}" class="w-1/3 rounded-none" style="height: calc(100% / 2);">
            <img src="{{ asset('img/2.jpg') }}" class="w-1/3 rounded-none" style="height: calc(100% / 2);">
            <img src="{{ asset('img/5.jpg') }}" class="w-1/3 rounded-none" style="height: calc(100% / 2);">

    	</div>
    </div>
    
    <welcome-view></welcome-view>
    
</div>


@endsection
