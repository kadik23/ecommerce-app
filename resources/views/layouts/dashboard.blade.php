<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-theme="cupcake">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('dashboard.name', 'Stanissk Store') }}</title> 
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    @vite('resources/css/app.css')
    @vite('resources/css/global.css')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @vite('resources/js/app.js')

    <!-- Pre-load theme script to prevent layout flashes -->
    <script>
        (function() {
            const theme = localStorage.getItem('admin-theme') || 'light';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                document.documentElement.setAttribute('data-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                document.documentElement.setAttribute('data-theme', 'cupcake');
            }
        })();
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-200 overflow-x-hidden">
    <div id="app" data-theme="cupcake" class="min-h-screen flex flex-col">
      @include('..components.admin.navbar')
      @include('..components.admin.sidebar')
      @yield('content1')
      @include('..components.admin.footer')
    </div>
 
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function() {
            function applyTheme(theme) {
                if (theme === 'dark') {
                    $('html').addClass('dark');
                    $('html').attr('data-theme', 'dark');
                    $('#app').attr('data-theme', 'dark');
                    $('.drawer').attr('data-theme', 'dark');
                } else {
                    $('html').removeClass('dark');
                    $('html').attr('data-theme', 'cupcake');
                    $('#app').attr('data-theme', 'cupcake');
                    $('.drawer').attr('data-theme', 'cupcake');
                }
                localStorage.setItem('admin-theme', theme);
            }

            // Sync initial state on document ready
            const currentTheme = localStorage.getItem('admin-theme') || 'light';
            applyTheme(currentTheme);

            $(document).on('click', '.theme-toggle-light', function(e) {
                e.preventDefault();
                applyTheme('light');
                $('details.dropdown').removeAttr('open');
            });

            $(document).on('click', '.theme-toggle-dark', function(e) {
                e.preventDefault();
                applyTheme('dark');
                $('details.dropdown').removeAttr('open');
            });
        });
    </script>

    @yield('script')
</body>
</html>
