@extends('layouts.app')

@section('content')
<div class="max-w-sm mx-auto">
    <div class="text-lg mt-4 mb-6 text-left font-semibold">
        {{ __('Reset Password') }}
    </div>
    <form method="POST" class="mt-10" action="{{ route('password.email') }}">
        @csrf

        <div class="max-w-sm mb-12">
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

        <div class="max-w-lg mb-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-6 rounded">
                      {{ __('Send Resent Password Request') }}
                </button>
        </div>
    </form>
</div>

                        
@endsection
