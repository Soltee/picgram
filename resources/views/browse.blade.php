@extends('layouts.app')

@section('head')

@endsection
@section('content')
<div class="">



    
    	<browse-posts /></browse-posts>
    
</div>
@endsection

@push('scripts')
{{-- <script src="{{ asset('/js/js-carousel.min.js') }}"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script> --}}
<script>
	// document.addEventListener('DOMContentLoaded', function(){
	// 	var elem = document.querySelector('.grid');
	// 		var msnry = new Masonry( elem, {
	// 		  // options
	// 		  itemSelector: '.grid-item',
	// 		  columnWidth: 200
	// 		});

	// 	// var carousel = new Carousel({
	// 	// 	elem: 'carousel',
	// 	// 	dots: true,
	// 	// 	arrows: true,
	// 	// 	buttons: true,
	// 	// 	autoplay: true,
	// 	// 	infinite: true
	// 	// });

	// 	var elem2 = document.querySelector('.posts');
	//     var infScroll = new InfiniteScroll( '.posts', {
	//       path: '?page=@{{#}}',
	//       append: '.post',
	//       history: false,
	//       status: '.page-load-status',
	//     });
	// });
</script>
@endpush
