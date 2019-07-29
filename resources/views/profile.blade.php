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
                <div class="d-flex flex-row mb-2 justify-items-center">
                  <h4 class="mr-2 ">{{ $user->name }}</h4>
                  @if(auth()->user()->id === $user->id)
                  @else
                    <follow-profile user="{{ $user->id }}" follows="{{ $follows }}"></follow-profile>
                  @endif
                </div>
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
                  <p>{{ str_limit($profile->about, '150', '...') }}</p>
                  <a href="" class="disabled">{{ $profile->url }}</a>
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
