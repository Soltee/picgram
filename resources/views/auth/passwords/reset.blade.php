@extends('layouts.app')

@section('content')
<div class="mx-auto min-h-screen flex bg-gray-500 flex-col justify-center items-center">
  
  <div class="bg-gray-900 flex flex-col justify-center items-center rounded-lg p-6">

    <div class="text-lg text-white  mb-6 text-left font-semibold">
        {{ __('Reset Password') }}
    </div>
    <form method="POST" class="mt-3" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="max-w-sm mb-4">
              <label class="block text-white text-md mb-2 font-semibold   " for="email">
                {{ __('E-Mail Address') }}
              </label>
              <input class="@error('email') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="*******@gmail.com">
              @error('email')
                        <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                @enderror
            </div>

        
            <div class="max-w-sm mb-4">
              <label class="block text-white text-md font-semibold mb-2    " for="password">
                {{ __('Password') }}
              </label>
              <input class="@error('password') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus placeholder="**********">
              @error('password')
                        <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                @enderror
            </div>

            <div class="max-w-sm mb-3">
              <label class="block text-white text-md font-semibold mb-2    " for="password-confirm">
                {{ __('Confirm Password') }}
              </label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password-confirm" type="password" name="password_confirmation"  required autocomplete="new-password" autofocus placeholder="**********">

            </div>


        
            <div class="w-full mt-6">
                <button class="w-full bg-blue-500 hover:bg-blue-700 text-white py-2 px-6 mr-2 rounded">
                      {{ __('Reset Password') }}
                </button>
                
            </div>

    </form>
  </div>
</div>

        
@endsection
