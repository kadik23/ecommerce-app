@extends('layouts.accounts')

@section('content')
<div class="w-screen h-screen flex items-center justify-center bg-regal-brown px-4">
    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl border border-gray-100 flex flex-col justify-center">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-24 rounded-full w-24" src="{{ asset('assets/images/logo.png') }}" alt="Logo" />
            <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ __('Verify Your Email') }}</h2>
        </div>

        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm text-center">
            @if (session('resent'))
                <div class="mb-4 p-4 rounded-lg bg-green-50 text-green-700 border border-green-200 text-sm" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <p class="text-sm text-gray-600 mb-6">
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
            </p>

            <form class="inline-block w-full" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="flex w-full justify-center rounded-md bg-regal-brown px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-amber-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">
                    {{ __('Click here to request another') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
