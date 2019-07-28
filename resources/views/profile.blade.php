@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-row">
        @guest

        @else
          <div class="col-md-2">
            @include('_partials.nav')
          </div>
        @endguest

        <div class="col-md-10">
            <div class="d-flex flex-row mb-4">
              <div class="col-md-2 mr-2">
                @if($profile->avatar)
                    <img class="user-img" src="{{ url('storage/'.$profile->avatar) }}">
                @else
                  <svg class="user-img-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
                @endif
              </div>
              <div class="col-md-10 d-flex flex-column">
                <h4>{{ $user->name }}</h4>
                <div class="d-flex flex-row mb-2">
                  <div class="d-flex flex-column align-items-center mr-2">
                    <button class="btn btn-primary">Posts</button>
                    <span class="font-weight-bold">{{ count($posts) }}</span>
                  </div>

                  <div class="d-flex flex-column align-items-center mr-2">
                    <button class="btn btn-primary">Followers</button>
                    <span class="font-weight-bold">{{ count($followers) }}</span>
                  </div>

                  <div class="d-flex flex-column align-items-center mr-2">
                    <button class="btn btn-primary">Following</button>
                    <span class="font-weight-bold">{{ count($following) }}</span>
                  </div>
                  
                  @can('update', $profile)
                    <div class="d-flex ml-auto">
                      <a href="{{ route('profile.edit', $user->id ) }}">Edit Profile</a>
                    </div>
                  @endcan

                </div>
                <!--Follow and posts ends-->
                <div class="d-flex flex-column">
                  <p>{{ str_limit('Lorem ipsum dolor sit amet, consectetur adipisicing elit, tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '150', '...') }}</p>
                  <a href="" class="disabled">https::/www.wwww.com</a>
                </div>
              </div>
              <!--right ends-->
            </div>


           <div class="mt-6 ">
                <div class="d-flex mb-4 text-center">
                    
                    @forelse($posts as $post)
                    <div class="mr-3">
                      <a href="{{ url('p', $post->id . '-' .$post->caption) }}">
                          <img class="post_image"  src="{{ asset('storage/'. $post->post_image ) }}">
                      </a>
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
