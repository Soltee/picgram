@extends('layouts.app')

@section('head')
@endsection
@section('content')
<div class="px-6 lg:px-3 py-3 mt-8 ">


    
    	<browse-posts /></browse-posts>


  
    
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script>
	// document.addEventListener('DOMContentLoaded', function(){
	// 	var elem = document.querySelector('.grid');
	// 		var msnry = new Masonry( elem, {
	// 		  // options
	// 		  itemSelector: '.grid-item',
	// 		  columnWidth: 200
	// 		});


	// });
</script>
@endpush
