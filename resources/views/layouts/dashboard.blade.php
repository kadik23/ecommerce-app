<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cupcake">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap"
  rel="stylesheet" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    {{-- <link rel="stylesheet" href={{asset('assets/css/style.css')}}> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" 
    />
    <title>dashboard</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/css/style.css')


    <!-- Scripts -->
</head>
<body>
    <div id="app" data-theme="cupcake">
      @include('..components.admin.navbar')
      @include('..components.admin.sidebar')
      @yield('content1')
      @include('..components.admin.footer')
    </div>
 
    <script src="{{ mix('js/components/app2.js') }}"></script>

    <script src="{{ mix('js/components/columnChart.js') }}"></script>
    <script src="{{ mix('js/components/incrementCounter.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script><script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @yield('script')
</body>
</html>
