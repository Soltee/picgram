@extends('layouts.app')

@section('content')
<div class="mx-auto min-h-screen flex bg-gray-500 flex-col justify-center items-center">
  <div class="bg-gray-900 flex flex-col justify-center items-center rounded-lg p-6">

    <div class="text-lg text-white  mb-6 text-left font-semibold">
        {{ __('Reset Password') }}
    </div>
    @if (session('status'))
        <div class="text-white p-2 border-2 text-center rounded border-blue-800 mb-2" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif
    <form method="POST" class="mt-10" action="{{ route('password.email') }}">
        @csrf

        <div class="max-w-sm mb-12">
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

        <div class="w-full flex flex-row justify-between items-center">
            <a href="/" class="flex justify-center items-center mr-2">
              <svg  class="h-8 w-8 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3.828 9l6.071-6.071-1.414-1.414L0 10l.707.707 7.778 7.778 1.414-1.414L3.828 11H20V9H3.828z"/></svg>
            </a>
            <button class="text-center bg-blue-500 hover:bg-blue-700 text-white py-2 px-6 rounded" type="submit">
              {{ __('Send Request') }}
            </button>
        </div>
    </form>
  </div>
</div>

                        
@endsection
