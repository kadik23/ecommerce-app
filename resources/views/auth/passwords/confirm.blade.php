@extends('layouts.accounts')

@section('content')
<div class="w-screen h-screen flex items-center justify-center bg-regal-brown px-4">
    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl border border-gray-100 flex flex-col justify-center">
        <a href="/" class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-24 rounded-full w-24" src="{{ asset('assets/images/logo.png') }}" alt="Logo" />
            <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ __('Confirm Password') }}</h2>
        </a>

        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
            <p class="text-sm text-gray-600 mb-6 text-center">
                {{ __('Please confirm your password before continuing.') }}
            </p>

            <form class="space-y-6" method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-700 float-left">{{ __('Password') }}</label>
                    <div class="mt-2">
                        <input id="password" type="password" class="block @error('password') is-invalid @enderror w-full pl-2 rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-regal-brown focus:border-regal-brown focus:outline-none sm:text-sm sm:leading-6" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="text-regal-brown text-xs mt-1 block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-regal-brown px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-amber-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">
                        {{ __('Confirm Password') }}
                    </button>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-center mt-4">
                        <a class="font-semibold text-sm text-regal-brown hover:text-amber-700" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
