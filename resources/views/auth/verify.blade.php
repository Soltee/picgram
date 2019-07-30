@extends('layouts.app')

@section('content')
<div class="max-w-sm mx-auto">
    <div class="text-lg mt-4 mb-6 text-left font-semibold">
        {{ __('Verify Your Email Address') }}
    </div>
    @if (session('resent'))
        <div class="p-2 border-2 rounded border-blue-800 mb-2" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    <p class="leading-tight">{{ __('Before proceeding, please check your email for a verification link.') }} {{ __('If you did not receive the email') }}, </p>
    <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
</div>

@endsection
