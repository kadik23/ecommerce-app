<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('profile.name', 'Laravel') }}</title>
    <!-- Styles link-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" >
    @vite('resources/css/app.css')
    @vite('resources/css/global.css')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
</head>     
<body>
    <div id="app" data-theme="bumblebee">  
        @if((Auth::check()))      
            @if(Auth::user()->hasRole('user')) 
            <nav class="bg-white border-gray-200 dark:bg-gray-900 ">
                <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 ">
                    <div class="flex items-center">

                        <p class="mr-6  text-sm flex items-center text-gray-500 dark:text-white">
                            <span class="material-symbols-outlined text-regal-brown" style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 20">call</span>
                            <span>Free Support</span> (213) 0798816073
                        </p>
                    </div>
                    <div class="flex items-center" id="categories" >
                        <ul class="flex flex-row mt-0 mr-6 space-x-8 text-sm" >
                            <li>
                                <a href="{{route('welcome')}}" class="text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500" aria-current="page">Home</a>
                            </li>
                            <li>
                                <a href="{{route('myorders')}}" class="text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500">MY ORDERS</a>
                            </li>
                            <li>
                                <a href="{{route('paymentmethod')}}" class="text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500">PAYMENT METHOD</a>
                            </li>
                            <li>
                                <a href="{{route('dash.myprofile')}}" class="text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500">PROFILE</a>
                            </li>
                        </ul>
                    </div>
                    <div class="flex items-center">
                        @php
                            $items=['Login','Register'];
                            $items2=['English','Arabic'];
                            $items3=['Profile','Logout'];
                            $links=['login','register'];
                            $links2=['english','arabic'];
                            $links3=['dash.myprofile','logout']
                        @endphp
                        @if(Auth::check())
                        <x-dropdown :items="$items3" label="My account"  :links="$links3"/>
                        @else
                        <x-dropdown :items="$items" label="My account"  :links="$links"/>
                        @endif
                        {{-- <x-dropdown :items="$items2" label="Languages" :links="$links2"/> --}}
                        <div class="dropdown" style="background-color: transparent">
                            <label tabindex="0" class="btn hover:text-regal-brown py-0 font-normal m-1" style="background-color: transparent; border:none;" >
                                Languages<span class="material-symbols-outlined">arrow_drop_down</span>
                            </label>
                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                    <li><a href="#">english</a></li>
                                    <li><a href="#">arabic</a></li>
                            </ul>
                        </div>
                        <a href="#" class="text-md mx-2 hover:text-regal-brown transition-all duration-500 py-0">Contact Us</a>
                    </div>
                </div>
            </nav>
            @endif
        @endif
        <div>
            @yield('content')
        </div>
    </div>
</body>
</html>
