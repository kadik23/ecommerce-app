<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - {{ t('admin.errors.page_not_found', [], 'Page Not Found') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite('resources/css/app.css')
    @vite('resources/css/global.css')
    <script>
        (function() {
            const theme = localStorage.getItem('admin-theme') || 'light';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full text-center bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-8 shadow-xl">
        <div class="inline-flex items-center justify-center w-24 h-24 bg-amber-100 dark:bg-amber-900/30 text-regal-brown dark:text-amber-400 rounded-full mb-6">
            <span class="material-symbols-outlined text-5xl">error_med</span>
        </div>

        <h1 class="text-6xl font-black text-regal-brown dark:text-amber-400 mb-2">404</h1>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
            {{ t('admin.errors.page_not_found') }}
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
            {{ t('admin.errors.page_not_found_desc') }}
        </p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            @if(Auth::check() && Auth::user()->hasRole('admin'))
                <a href="{{ route('admin') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-regal-brown hover:bg-amber-700 rounded-xl shadow-sm transition-colors">
                    <span class="material-symbols-outlined me-2 text-base">dashboard</span>
                    {{ t('admin.errors.back_to_dashboard') }}
                </a>
            @else
                <a href="/" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-regal-brown hover:bg-amber-700 rounded-xl shadow-sm transition-colors">
                    <span class="material-symbols-outlined me-2 text-base">home</span>
                    {{ t('admin.errors.back_to_home') }}
                </a>
            @endif
        </div>
    </div>
</body>
</html>
