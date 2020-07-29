@extends('layouts.app')

@section('content')
<div class="min-h-screen overflow-hidden  bg-c-white z-20 px-6  md:px-0 flex flex-col justify-center md:items-center mx-auto max-w-6xl">
        <div class="z-20 mt-6 flex flex-col md:items-center">
            <div class="flex flex-row justify-center items-center md:w-88">
                <svg class="h-12 w-12 text-c-blue pr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                </svg>
                <span class="pl-2 border-white border-l-2 font-serif text-c-blue text-xl font-black">PicGram</span>
            </div>
            <div class="text-sm text-c-blue mt-1  items-center mb-4 text-center font-semibold">
                {{ __('Reset Password') }}
            </div>


            @if (session('status'))
                <p class="text-c-blue p-2  text-center rounded mb-2" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </p>
            @endif

            <form method="POST" class="mt-4" action="{{ route('password.email') }}" class="mt-8">
              @csrf
                <div class="w-full md:w-88 ">
                    <div class="mb-4  w-full">
                        <label class="block text-c-blue text-md mb-2 font-light   " for="email">
                            Email
                        </label>
                        <input class="@error('email') is-invalid @enderror shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="*******@gmail.com">
                        @error('email')
                                <p style="color:red;" class="mt-2 px-1 py-1 text-sm text-red-500  " role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                        @enderror
                    </div>
                    
                    <div class="flex flex-col my-4 w-full md:w-88">
                        <button  type="submit" id="logBtn" class="w-full mb-2 font-bold text-lg bg-c-blue-dark hover:opacity-75 text-c-white py-3 px-6 rounded">
                            Send Request
                        </button>
                        <a class="btn btn-link w-full  text-center text-c-blue text-sm" href="/">
                            Back to Site
                        </a>

                    </div>
                </div>
            </form>
        </div>
       
  </div>
    
 
                        
@endsection
