@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto flex flex-wrap justify-center">
     
    <div class="lg:w-4/5 md:w-3/5 w-full mb-16 flex flex-col">
        <div class="m-0 p-0 flex flex-row  mb-4">
            <div class="block  lg:mr-2 md:mr-2 mr-2">
                <div class="">
                  @if($profile->avatar)
                    <img class="lg:h-24 lg:w-24 md:w-16 md:h-16 h-8 w-8 bg-cover rounded-full" src="{{ url('storage/'. $profile->avatar) }}">
                  @else
                    <svg class="lg:h-24 lg:w-24 md:w-16 md:h-16 h-12 w-12 bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
                  @endif
                </div>
                
            </div>
            <div class="lg:w-4/5 md:w-4/5 w-auto flex flex-col">
                
                <!-- Author Top -->
                <div class="relative flex flex-row justify-between items-baseline">
                  <div class="flex flex-row mb-2 items-baseline">
                    <h4 class="mr-3 text-gray-600 font-semibold capatialize">{{ $user->name }}</h4>
                    @if(auth()->user()->id === $user->id)
                    @else
                      <follow-profile user="{{ $user->id }}" follows="{{ $follows }}"></follow-profile>
                    @endif
                  </div>
                  @can('update', $profile)
                      <div class="flex absolute top-0 right-0">
                        <a class="px-1 py-1   text-white rounded text-center" href="{{ route('profile.edit', $user->id ) }}">
                          <svg class="h-6 w-6 text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg>
                        </a>
                      </div>
                @endcan
                  
                </div>
                <!-- Author Top  ENDS-->
                <div class="flex flex-row justify-between mt-2 mb-2">
                  <div class="flex">
                    <div class="flex flex-col items-center mr-2">
                      <button class="px-1 py-1 bg-blue-700 text-white lg:font-semibold md:font-semibold rounded">Posts</button>
                      <span class="font-weight-bold">{{ count($posts) }}</span>
                    </div>

                    <div class="flex flex-col items-center mr-2">
                      <button class="px-1 py-1 bg-blue-700 text-white lg:font-semibold md:font-semibold rounded">Followers</button>
                      <span class="font-weight-bold">{{ count($followers) }}</span>
                    </div>

                    <div class="flex flex-col items-center mr-2">
                      <button class="px-1 py-1 bg-blue-700 text-white lg:font-semibold md:font-semibold rounded">Following</button>
                      <span class="font-weight-bold">{{ count($following) }}</span>
                    </div>
                  </div>
                  
                  

                </div>
                <!--Follow and posts ends-->
                <div class="flex flex-col">
                  <p>{{ str_limit($profile->about, '150', '...') }}</p>
                  <a href="" class="disabled">{{ $profile->url }}</a>
                </div>
            </div>
            
        </div>
        <!--Top ENDS-->

        <div class="mt-6">
            <div class="flex flex-row flex-wrap mb-4 text-center">
                
                @forelse($posts as $post)
                <div class="mr-3 mb-3">
                  <a href="{{ url('p', $post->id . '-' .$post->caption) }}">
                      <img class="lg:w-24 lg:h-24 md:h-24 md:w-24 w-auto"  src="{{ asset('storage/'. $post->post_image ) }}">
                  </a>
                </div>
               @empty
                <div class="p-2 text-red-900">
                    No Posts Yet;
                </div>
               @endforelse

            </div>
            

           <div class="items-center">
               {{ $posts->links() }}
           </div>
        </div>
        <!-- Post  SectionEnds --->
    </div>

    <div class="lg:w-1/5 md:w-2/5 w-full lg:static md:static fixed left-0 bottom-0 lg:bg-transparent md:bg-transparent lg:p-0 md:p-0 pb-0 pt-2 bg-gray-400">
      @include('_partials.nav')
    </div>
    
</div>
 
@endsection
