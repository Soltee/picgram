<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Picgram</title>
    <link rel="shortcut icon" type="image/svg" href="/img/instagram.svg"/>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @yield('head')
</head>
<body class="">
    <div id="app">
        @include('sweetalert::alert')

        @auth

            <nav class="   px-6 py-4 md:px-16  border-white border-b-2">
                <div class="flex justify-between items-center lg:max-w-4xl lg:mx-auto">
                    <div class="flex items-center">
                        <a class="flex flex-row items-center mr-6" href="{{ url('/') }}">
                            <svg class="h-8 w-8 text-blue-light pr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                            <span class="pl-2 border-c-blue-800 border-l-2 font-serif text-md md:text-lg text-blue-light font-thin">Picgram</span>
                        </a>
                        <search-model></search-model>
                    </div>
                    <div class="flex items-center">
                        <ul class="hidden md:inline-flex justify-end items-center">
                            <li class="mr-4  hover:opacity-75 {{ Route::currentRouteName() == 'home' ? 'opacity-75' : 'text-blue-light' }}">
                                <a class="" href="{{ route('home') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 border rounded-lg border-blue-light p-1 hover:bg-blue-light hover:text-c-white  text-blue-light" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                </a>
                            </li>
                            <li class="mr-4  hover:opacity-75 {{ Route::currentRouteName() == 'posts.create' ? 'opacity-75' : 'text-blue-light' }}">
                                <a class="" href="{{ route('posts.create') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 border rounded-lg border-blue-light p-1 hover:bg-blue-light hover:text-c-white  text-blue-light" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                                </a>
                            </li>
                            <li class="mr-4  hover:opacity-75 {{ Route::currentRouteName() == 'browse' ? 'opacity-75' : 'text-blue-light' }}">
                                <a class="" href="{{ route('browse') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 border rounded-lg border-blue-light p-1 hover:bg-blue-light hover:text-c-white  text-blue-light" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                                </a>
                            </li>
                           
                        </ul>
                        
                        {{-- {{auth()->user()->profile}} --}}
                        <logout-modal :auth="{{ auth()->user() }}" :profile="{{ auth()->user()->profile }}"></logout-modal> 

                    </div>          
                </div>

            </nav>

            <div class="lg:max-w-4xl lg:mx-auto mb-12  px-6 md:px-8 mt-10">
                @yield('content')
            </div>

        @endauth
        
        @yield('authentication')

        @auth
            <div class="md:hidden fixed bottom-0 w-full bg-white  border-t border-b">
                @include('_partials.nav')
            </div>
        @endauth

        
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(){

            const images = document.querySelectorAll("img");

            const imgOptions = {};
            const imgObserver = new IntersectionObserver((entries, imgObserver) => {
              entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                const img = entry.target;
                img.src = img.src.replace("w=10&", "w=800&");
                imgObserver.unobserve(entry.target);
              });
            }, imgOptions);

            images.forEach((img) => {
              imgObserver.observe(img);
            });

        });
    </script>


</body>
</html>

