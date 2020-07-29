@extends('layouts.app')

@section('content')
<div class="flex justify-between  px-3 py-3 md:px-16 ">

    
    <div class="w-full flex-1 mb-24">
    	{{-- <div v-masonry origin-left="false" transition-duration="1s" item-selector=".item">
		  <div v-masonry-tile class="item" v-for="(item, index) in blocks">
		    <p><lorem add="1-3s"></lorem></p>
		  </div>
		</div>  --}}
    	<browse-posts></browse-posts>
    </div>

  
    
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/vue-masonry@0.11.3/dist/vue-masonry-plugin-window.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function(){
		// var VueMasonryPlugin = window["vue-masonry-plugin"].VueMasonryPlugin
		// Vue.use(VueMasonryPlugin)
	});
</script>
@endpush
