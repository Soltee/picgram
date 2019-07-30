@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto flex flex-wrap justify-center">

           
    <div class="lg:w-4/5 md:w-3/5 w-full mb-16">
    	<browse-posts></browse-posts>
    </div>

    <div class="lg:w-1/5 md:w-2/5 w-full lg:static md:static fixed left-0 bottom-0 lg:bg-transparent md:bg-transparent lg:p-0 md:p-0 pb-0 pt-2 bg-gray-400">
    	@include('_partials.nav')
    </div>
    
</div>
@endsection
