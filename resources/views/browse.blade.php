@extends('layouts.app')

@section('content')
<div class="flex justify-between  px-3 py-3 md:px-16 ">

    
    <div class="w-full flex-1 mb-16">
    	<browse-posts></browse-posts>
    </div>

    <div class="md:w-auto fixed bottom-0 left-0 w-full md:static  rounded-lg">
    	@include('_partials.nav')
    </div>
   {{--   <div class="md:40 w-full lg:static md:static fixed left-0 bottom-0 lg:bg-transparent md:bg-transparent lg:p-0 md:p-0 pb-0 pt-2 bg-gray-400">
    	@include('_partials.nav')
    </div> --}}
    
</div>
@endsection
