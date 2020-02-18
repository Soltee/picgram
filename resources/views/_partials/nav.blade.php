<div>
    <div class="hidden md:flex md:items-center">
        @if(Auth::user()->profile->avatar)
            <a class="" href="/profile/{{ Auth::user()->id }}/{{ Auth::user()->name }}">
                <img class="lg:h-24 lg:w-24 md:w-16 md:h-16  bg-cover rounded-full" src="/storage/{{  Auth::user()->profile->avatar }}">
            </a>
        @else
            <a class="" href="/profile/{{ Auth::user()->id }}/{{ Auth::user()->name }}">
                <svg class="lg:h-24 lg:w-24 md:w-16 md:h-16 h-12 w-12 bg-cover rounded-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/></svg>
            </a>
        @endif
    </div>
</div>
<ul class="mt-3 w-full px-2 py-2 flex lg:flex-col md:flex-col flex-row justify-center items-center">

    <li class="nav-item  mb-3 lg:mr-0 md:mr-0 mr-2">
        <a class="" href="{{ route('home') }}">
            <svg class="w-8 h-8 md:w-10 md:h-10 mr-2 p-2  hover:bg-gray-800 hover:text-gray-300 {{ Route::currentRouteName() == 'home' ? 'bg-gray-800 text-gray-300' : 'text-gray-800' }}" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M8 20H3V10H0L10 0l10 10h-3v10h-5v-6H8v6z"/></svg>
            {{-- <span class="">Home</span> --}}
        </a>
    </li>
    <li class="nav-item  mb-3 lg:mr-0 md:mr-0 mr-2">
        <a class="" href="{{ route('posts.create') }}">
            <svg class="w-8 h-8 md:w-10 md:h-10 mr-2 p-2  hover:bg-gray-800 hover:text-gray-300 {{ Route::currentRouteName() == 'posts.create' ? 'bg-gray-800 text-gray-300' : 'text-gray-800' }}" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 10v6H7v-6H2l8-8 8 8h-5zM0 18h20v2H0v-2z"/></svg>
            {{-- <span class="">Upload</span> --}}
        </a>
    </li>
    <li class="nav-item  mb-3 lg:mr-0 md:mr-0 mr-2">
        <a class="" href="{{ route('browse') }}">
            <svg class="w-8 h-8 md:w-10 md:h-10 mr-2 p-2  hover:bg-gray-800 hover:text-gray-300 {{ Route::currentRouteName() == 'browse' ? 'bg-gray-800 text-gray-300' : 'text-gray-800' }}" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7.88 7.88l-3.54 7.78 7.78-3.54 3.54-7.78-7.78 3.54zM10 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg>
            {{-- <span class="">Browse</span> --}}
        </a>
    </li>
   
</ul>