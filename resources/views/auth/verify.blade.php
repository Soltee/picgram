@extends('layouts.app')

@section('content')
<div class="max-w-sm mx-auto md:mt-12 bg-gray-900 flex flex-col justify-center items-center rounded-lg">
    <div class="text-lg md:text-2xl mt-4 mb-6 text-white font-semibold text-center">
        {{ __('Verify Your Email Address') }}
    </div>
    @if (session('resent'))
        <div class="text-white p-2 border-2 text-center rounded border-blue-800 mb-2" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    <p class="leading-tight text-white text-center leading-3">{{ __('Before proceeding, please check your email for a verification link.') }} {{ __('If you did not receive the email') }}, </p>
    <a onclick="event.preventDefault(); document.getElementById('verificationForm').submit();" class="text-white hover:bg-blue-500 font-bold mt-3 bg-blue-600 rounded-lg px-4 py-3" href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
    <form id="verificationForm" class="hidden" action="{{ route('verification.resend') }}" method="POST">
        @csrf
        <button type="submit">Submit</button>
    </form>
</div>

@endsection
