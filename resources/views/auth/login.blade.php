@extends('layouts.accounts')

@section('content')
<div class=" w-screen lg:h-screen flex flex-col lg:flex-row ">
    <div class="h-full w-auto lg:w-1/2 flex flex-1 flex-col justify-center lg:px-8 px-10 lg:pb-0">
        <a href="/" class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-24 rounded-full  w-24" src="{{ asset('assets/images/logo.png') }}" alt="Your Company" />
            <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight ">Sign in to your account</h2>
        </a>
        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 float-left" >{{ __('Email Address') }}</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required autofocus   value="{{ old('email') }}"  class="block  @error('email') is-invalid @enderror w-full pl-2 rounded-md border-0 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 outline-regal-brown sm:text-sm sm:leading-6" />
                        @error('email')
                            <span class="invalid-feedback " role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 ">{{ __('Password') }}</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="text-sm">
                            @if (Route::has('password.request'))
                                <a class="font-semibold text-regal-brown hover:text-amber-700" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required="" class="block pl-2  w-full rounded-md border-0 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300  outline-regal-brown sm:text-sm sm:leading-6" />
                    </div>
                </div>
                <div>
                    <h2 class="text-center">Or</h2>
                    <img src="{{ asset('assets/images/icons8-google-48.png') }}" class="h-8 mx-auto mb-4 cursor-pointer" alt="">
                    <button type="submit" class="flex w-full justify-center rounded-md bg-regal-brown  px-3 py-1.5 mb-4 lg:mb-4 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-amber-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2  " >{{ __('Login') }}</button>
                </div>
                
            </form>
        </div>
    </div>
    
    <div class="lg:h-full w-full lg:w-1/2 flex flex-col ">
        <img src="{{ asset('assets/images/background.svg')}}" alt="" >
        <div class="px-8  h-1/2"  style="background-color: #f5ecd9; padding-bottom:.9rem; padding-top:.9rem;"> 
            <h1 class=" text-2xl font-bold" style="margin: 0.4rem;"> New Here ?</h1>
            <h3 class="m-1 "> Sign up and discover a great amount of new opportunities!</h3>
            <br>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="flex lg:w-1/6 w-4/6 mx-auto justify-center rounded-md bg-regal-brown  px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-amber-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2  " >{{ __('Sign up') }}</a>
            @endif
        </div>
    </div>     
    
</div>
@endsection
