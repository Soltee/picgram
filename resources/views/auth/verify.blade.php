@extends('layouts.app')

@section('authentication')
<div class="min-h-64 overflow-hidden  bg-c-white z-20 px-6  md:px-0 flex flex-col justify-center md:items-center mx-auto max-w-6xl">
    <div class="z-20 mt-6 flex flex-col md:items-center">
        <div class="text-lg md:text-2xl mt-4 mb-6 text-c-blue font-semibold text-center">
            {{ __('Verify Your Email Address') }}
        </div>
        @if (session('resent'))
            <div class="text-c-blue p-2 border-2 text-center rounded border-blue-800 mb-2" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <p class="leading-tight text-c-blue text-center leading-3">{{ __('Before proceeding, please check your email for a verification link.') }} {{ __('If you did not receive the email') }}, </p>
        <a onclick="event.preventDefault(); document.getElementById('verificationForm').submit();" class="text-c-white hover:opacity-75 font-bold mt-3 bg-c-blue-dark rounded-lg px-4 py-3" href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
        <form id="verificationForm" class="hidden" action="{{ route('verification.resend') }}" method="POST">
            @csrf
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

@endsection
