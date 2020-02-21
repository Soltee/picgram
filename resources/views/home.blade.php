@extends('layouts.app')

@section('content')
<div class="flex justify-between  px-3 py-3 md:px-64 ">

    
    <div class="w-full flex-1 mb-16">
        <home-posts></home-posts>
    </div>

    <div class="md:w-auto fixed bottom-0 left-0 w-full md:static  rounded-lg pl-3 flex flex-col items-center">
    	@include('_partials.nav')
    </div>
    
</div>
@endsection
