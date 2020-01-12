@extends('layouts.app')

@section('content')
<div class="max-w-sm mx-auto">
    <div class="text-lg mt-4 mb-6 text-center font-semibold">
        {{ __(' Create An Account') }}
    </div>
    <form method="POST" class="mt-10" action="{{ route('register') }}">
        @csrf

        <div class="max-w-sm mb-3">
            <label class="block text-white-700 text-md mb-2  font-semibold  " for="name">
                {{ __('Name') }}
            </label>
            <input class="@error('name') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="name" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="*******">
            @error('name')
                    <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
            @enderror
        </div>

        <div class="max-w-sm mb-3">
              <label class="block text-white-700 text-md mb-2 font-semibold   " for="email">
                {{ __('E-Mail Address') }}
              </label>
              <input class="@error('email') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="*******@gmail.com">
              @error('email')
                        <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                @enderror
            </div>

        
            <div class="max-w-sm mb-3">
              <label class="block text-white-700 text-md font-semibold mb-2    " for="emails">
                {{ __('Password') }}
              </label>
              <input class="@error('password') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" value="{{ old('password') }}"  autocomplete="password" autofocus placeholder="**********">
              @error('password')
                        <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                @enderror
            </div>

           
            <div class="max-w-sm mb-3">
              <label class="block text-white-700 text-md font-semibold mb-2    " for="password-confirm">
                {{ __('Confirm Password') }}
              </label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password-confirm" type="password" name="password_confirmation"   autocomplete="new-password" autofocus placeholder="**********">

            </div>

            <div class="flex justify-between  my-4 mb-4 max-w-lg mb-3">
                <button class="bg-blue-500 hover:bg-blue-700 text-white py-0 px-6 mr-2 rounded">
                      {{ __('Register') }}

                </button>

                <a class="" href="{{ route('login') }}">
                    <button class="bg-gray-200  font-semibold  py-2 px-4  rounded">    
                        {{ __('Go Back') }}
                    </button>
                </a>
                
            </div>

    </form>
</div>

   
@endsection
