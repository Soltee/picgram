<div class="md:hidden py-3 md:py-0">

    <ul class="w-full flex lg:flex-col md:flex-col flex-row justify-around items-center bg-white">
        <li class="border rounded-full  hover:opacity-75 {{ Route::currentRouteName() == 'profile' ? 'opacity-75' : 'text-c-blue' }}">
                <a class="" href="/profile/{{ Auth::user()->id }}/{{ Auth::user()->name }}">
                    @if(Auth::user()->profile->avatar)
                    <img  class="w-8 h-8    bg-cover rounded-full" src="/storage/{{  Auth::user()->profile->avatar }}">
                    @else
                        <svg class="w-8 h-8    bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z" /></svg>
                    @endif
                </a>
            
        </li>
        <li class="border rounded-full  hover:opacity-75 {{ Route::currentRouteName() == 'home' ? 'opacity-75' : 'text-c-blue' }}">
            <a class="" href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-c-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            </a>
        </li>
        <li class="border rounded-full  hover:opacity-75 {{ Route::currentRouteName() == 'posts.create' ? 'opacity-75' : 'text-c-blue' }}">
            <a class="" href="{{ route('posts.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-c-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            </a>
        </li>
        <li class="border rounded-full  hover:opacity-75 {{ Route::currentRouteName() == 'browse' ? 'opacity-75' : 'text-c-blue' }}">
            <a class="" href="{{ route('browse') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-c-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
            </a>
        </li>
       
    </ul>

</div>