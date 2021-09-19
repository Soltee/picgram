<div class="md:hidden py-3 md:py-0">

    <ul class="w-full flex lg:flex-col md:flex-col flex-row justify-around items-center bg-white">
        <li class=" rounded-full  hover:opacity-75 ">
                <a class="" href="/profile/{{ Auth::user()->id }}/{{ Auth::user()->name }}">
                    @if(Auth::user()->profile->avatar)
                        <img  class="w-8 h-8    bg-cover rounded-full" src="/storage/{{  Auth::user()->profile->avatar }}">
                    @else
                        <svg  
                            xmlns="http://www.w3.org/2000/svg" 
                            class="w-8 h-8  border rounded-lg border-blue-light p-1 hover:bg-blue-light hover:text-c-white  text-blue-light   bg-cover rounded-full {{ Route::currentRouteName() == 'profile' ? 'bg-blue-light text-c-white' : '' }}" fill="none" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @endif
                </a>
            
        </li>
        <li class=" rounded-full  hover:opacity-75 ">
            <a class="" href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="h-8 w-8 border rounded-lg border-blue-light p-1 hover:bg-blue-light hover:text-c-white  text-blue-light
                    {{ Route::currentRouteName() == 'home' ? 'bg-blue-light text-c-white' : '' }}" 
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            </a>
        </li>
        <li class=" rounded-full  hover:opacity-75 ">
            <a class="" href="{{ route('posts.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" 
                class="h-8 w-8 border rounded-lg border-blue-light p-1 hover:bg-blue-light hover:text-c-white  text-blue-light
                {{ Route::currentRouteName() == 'posts.create' ? 'bg-blue-light text-c-white' : '' }} "
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            </a>
        </li>
        <li class=" rounded-full  hover:opacity-75 ">
            <a class="" href="{{ route('browse') }}">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="h-8 w-8 border rounded-lg border-blue-light p-1 hover:bg-blue-light hover:text-c-white  text-blue-light
                    {{ Route::currentRouteName() == 'browse' ? 'bg-blue-light text-c-white' : '' }}"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
            </a>
                            
        </li>
        
       
    </ul>

</div>