@extends('layouts.app')

@section('authentication')
<div class="min-h-64 overflow-hidden  bg-c-white z-20 px-6  md:px-0 flex flex-col justify-center md:items-center mx-auto">
    <div class="z-20 mt-6 flex flex-col px-3 py-3 rounded-lg shadow-2xl md:w-88">
        <div class="text-lg md:text-2xl mt-4 mb-6 text-blue-light font-semibold text-center">
            {{ __('Verify Your Email Address') }}
        </div>
        @if (session('resent'))
            <p class="text-blue-light p-2 my-3 text-center rounded rounded-lg bg-gray-200" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </p>
        @endif

        <p class="leading-tight text-blue-light text-center leading-3">{{ __('Before proceeding, please check your email for a verification link.') }} {{ __('If you did not receive the email') }}, </p>
        <a onclick="event.preventDefault(); document.getElementById('verificationForm').submit();" class="text-c-white hover:opacity-75 font-bold mt-3 bg-blue-light rounded-lg px-4 py-2 text-center" href="{{ route('verification.resend') }}">{{ __('Click here to resend.') }}</a>.
    <form id="verificationForm" class="hidden" action="{{ route('verification.resend') }}" method="POST">
            @csrf
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

@endsection
