@extends('layouts.app')

@section('content')
<div class="max-w-sm mx-auto">
    <div class="text-lg mt-4 mb-6 text-center font-semibold">
        {{ __(' Sign In') }}
    </div>
    <form method="POST" class="mt-10" action="{{ route('login') }}">
        @csrf

        <div class="max-w-sm mb-4">
              <label class="block text-white-700 text-md mb-2 font-semibold   " for="email">
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
              <label class="block text-white-700 text-md font-semibold mb-2    " for="password">
                {{ __('Password') }}
              </label>
              <input class="@error('password') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus placeholder="**********">
              @error('password')
                        <p style="color:red;" class="mt-2 px-1 py-1  border-2 rounded" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                @enderror
            </div>

           
            <div class="max-w-lg mb-4">
                
                <input class="p-1 rounded" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label font-normal" for="remember">
                    {{ __('Remember Me') }}
                </label>
                   
            </div>

            <div class="flex justify-between  my-4 mb-4 max-w-lg mb-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white py-0 px-6 mr-2 rounded">
                      {{ __('Login') }}

                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        <button class="bg-gray-200  font-semibold  py-2 px-4  rounded">    
                            {{ __('Forgot Your Password?') }}
                        </button>
                    </a>
                @endif
                
            </div>

    </form>
</div>

       
@endsection
