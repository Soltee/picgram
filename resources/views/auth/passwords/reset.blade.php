@extends('layouts.app')

@section('authentication')
<div class="min-h-screen overflow-hidden  bg-c-white z-20 px-6  md:px-0 flex flex-col justify-center md:items-center mx-auto max-w-6xl">
        <div class="z-20 mt-6 flex flex-col px-3 py-3 rounded-lg shadow-2xl">
            <div class="flex flex-col justify-center md:w-88">
                <div class="flex flex-row items-center ">
                    <svg class="h-10 w-10 text-blue-light pr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                    </svg>
                    <span class="border-white border-l-2 font-serif text-blue-light text-md md:text-xl font-black">PicGram</span>
                </div>
                <p class="font-serif text-blue-light text-xs font-normal ">Reset Password</p>
            </div>
            

           <form method="POST" class="mt-4" action="{{ route('password.update') }}" class="mt-8">
              @csrf
                <div class="w-full md:w-88 ">
                    <div class="w-full">
                        @if (session('status'))
                            <p class="text-blue-light p-2 my-3 text-center rounded rounded-lg bg-gray-200" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                    
                    <div class="mb-4  w-full">
                        <label class="block text-blue-light text-xs font-light   " for="email">
                            Email
                        </label>
                        <input class="@error('email') is-invalid @enderror shadow appearance-none border rounded w-full py-3 px-3 text-blue-light leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" value="{{ old('email') ?? $email }}" required autocomplete="email" autofocus placeholder="*******@gmail.com">
                        @error('email')
                                <p style="color:red;" class="mt-2 px-1 py-1 text-sm b rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                        @enderror
                    </div>
                    <div class="w-full mb-4">
                      <label class="block text-blue-light text-xs font-light    " for="password">
                        {{ __('Password') }}
                      </label>
                      <input class="@error('password') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-blue-light leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus placeholder="**********">
                      @error('password')
                                <p style="color:red;" class="mt-2 px-1 py-1  text-sm rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                        @enderror
                    </div>

                    <div class="w-full mb-6">
                      <label class="block text-blue-light text-xs font-light    " for="password-confirm">
                        {{ __('Confirm Password') }}
                      </label>
                      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-blue-light leading-tight focus:outline-none focus:shadow-outline" id="password-confirm" type="password" name="password_confirmation"  required autocomplete="new-password" autofocus placeholder="**********">

                    </div>
                            
                    <div class="flex flex-col mt-4 w-full md:w-88">
                        <button  type="submit" id="logBtn" class="w-full font-bold text-lg bg-blue-light hover:opacity-75 text-c-white py-2 px-6 rounded">
                            Reset Password
                        </button>
                        
                    </div>

                     <div class="flex justify-center">

                        <a class=" mt-1 text-center text-blue-light w-auto text-xs border-b border-transparent hover:border-blue-light" href="/">
                            Back to Landing Page
                        </a>

                    </div>
                </div>
            </form>
        </div>
       
  </div>

</div>

        
@endsection
