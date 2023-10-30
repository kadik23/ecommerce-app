<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles link-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" >
    @vite('resources/css/app.css')
    @vite('resources/css/global.css')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    @vite('resources/js/app.js')
</head>     
<body>
    @auth
    <input type="hidden" id="userId" value="{{ auth()->user()->id }}">
    @endauth
    <div id="app" data-theme="bumblebee">
        @php
            $categories = isset($categories) ? $categories : []; // Initialize as an empty array if not set
        @endphp
        <x-users.navbar :categories="$Categories"/>       
        <main>
            @yield('content')
        </main>
        <x-users.footer />
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script><script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@yield('script')
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsToggle = notificationsWrapper.find('div[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('div[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var ulElement = document.getElementById("scrollable-container");

    // reset notifications count to 0
    function resetToZero() {
        notificationsCount = 0
        notificationsCountElem.attr('data-count', notificationsCount)
        notificationsWrapper.find('.notif-count').text(notificationsCount)
        notificationsWrapper.show()
    } 

    // create pusher object
    var pusher = new Pusher('d0608be6bc44e0f552bf', {
        cluster: 'mt1'
        // encrypted:true
        // authEndpoint: '/broadcasting/auth'
    });

    // Subscribe to the channel we specified in our Laravel Event
    yourUserId = document.getElementById('userId').value
    const channelName = 'user.' + yourUserId;
    var channel = pusher.subscribe(channelName);

    // Bind a function to a Event (the full Laravel class)
    channel.bind('my-event', function (data) {
        // console.log('Received newPanier event:', data);
        // Handle the newPanier event data here
            notificationsCount += 1
            notificationsCountElem.attr('data-count', notificationsCount)
            notificationsWrapper.find('.notif-count').text(notificationsCount)
            notificationsWrapper.show()
            let template = `    <a href="#" class="flex px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <div class="w-32 overflow-hidden">
                                        <img class="object-cover h-20" src="{{asset('assets/images/products/${data.img}')}}" alt="Bonnie image">

                                    </div>
                                    <div class="w-full pl-3">
                                        <div class="text-gray-500 text-md mb-1 dark:text-gray-400"><span class="font-bold text-gray-900 dark:text-white">${data.product_name}</div>
                                            <div class="text-gray-500 text-sm mb-1 dark:text-gray-400"><span class="opacity-80 text-gray-900 dark:text-white">${data.admin}</div>
                                        <div class="text-lg text-bold text-regal-brown dark:text-regal-amber-700">${data.product_price}</div>
                                    </div>
                                </a>
                            `
            let template2= `<hr class="opacity-70 p-0">`
            var lastAElement = ulElement.querySelector("li:last-child a");
            if (lastAElement) {
                var newLiElement = document.createElement("li");
                newLiElement.innerHTML = template;
                // Insert the new <li> element before the parent of the last <a> tag
                lastAElement.parentElement.before(newLiElement);
                // Insert the horizontal line after the new <li> element
                newLiElement.insertAdjacentHTML('afterend', template2);          
            }
    });

// channel.bind('pusher:subscription_succeeded', function(data) {
//     console.log('Subscription to new-panier channel succeeded:', data);
// });
</script>
</html>
