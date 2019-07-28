@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-row">
        <div class="col-md-2">
            @include('_partials.nav')
        </div>

        <div class="col-md-10">

           <div class="">
                <div class="d-flex mb-4 text-center">
                    
                    @forelse($posts as $post)
                    <div class="mr-3">
                       <img class="post_image"  src="{{ asset('storage/'. $post->post_image ) }}">
                    </div>
                   @empty
                    <div class="alert alert-error">
                        No Posts Yet;
                    </div>
                   @endforelse

                </div>
                

               <div class="align-center">
                   {{ $posts->links() }}
               </div>
           </div>
        </div>
    </div>
</div>
@endsection
