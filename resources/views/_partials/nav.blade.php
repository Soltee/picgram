<ul class="m-0 p-0 w-auto flex lg:flex-col md:flex-col flex-row justify-center items-center">
    <li class="nav-item  mb-3 lg:mr-0 md:mr-0 mr-2">
        <a class="nav-link hover:bg-gray-500 p-2 rounded flex items-end lg:flex-row md:flex-row flex-col" href="{{ route('home') }}">
            <svg class="w-6 h-6 mr-2 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M8 20H3V10H0L10 0l10 10h-3v10h-5v-6H8v6z"/></svg>
            <span class="">Home</span>
        </a>
    </li>
    <li class="nav-item  mb-3 lg:mr-0 md:mr-0 mr-2">
        <a class="nav-link hover:bg-gray-500 p-2 rounded flex items-end lg:flex-row md:flex-row flex-col" href="{{ route('posts.create') }}">
            <svg class="w-6 h-6 mr-2 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 10v6H7v-6H2l8-8 8 8h-5zM0 18h20v2H0v-2z"/></svg>
            <span class="">Upload</span>
        </a>
    </li>
    <li class="nav-item  mb-3 lg:mr-0 md:mr-0 mr-2">
        <a class="nav-link hover:bg-gray-500 p-2 rounded flex items-end lg:flex-row md:flex-row flex-col" href="{{ route('browse') }}">
            <svg class="w-6 h-6 mr-2 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7.88 7.88l-3.54 7.78 7.78-3.54 3.54-7.78-7.78 3.54zM10 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg>
            <span class="">Browse</span>
        </a>
    </li>
    <li class="nav-item  mb-3 lg:mr-0 md:mr-0 ">
        <a class="nav-link hover:bg-gray-500 p-2 rounded flex items-end lg:flex-row md:flex-row flex-col" href="{{ url('profile', Auth::user()->id) }}">
            <svg class="w-6 h-6 mr-2 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5 5a5 5 0 0 1 10 0v2A5 5 0 0 1 5 7V5zM0 16.68A19.9 19.9 0 0 1 10 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/></svg>
            <span class="">Profile</span>
        </a>
    </li>
</ul>