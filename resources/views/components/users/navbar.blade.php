    <!-- Top Bar -->
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4">
            <div class="flex items-center">
                <p class="mr-6 text-xs lg:text-sm flex items-center text-gray-500 dark:text-white">
                    <span class="material-symbols-outlined text-regal-brown" style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 20">call</span>
                    <span>Free Support</span> (213) 0798816073
                </p>
            </div>
            <div class="flex items-center">
                @php
                    $items = ['Login', 'Register'];
                    $items2 = ['English', 'Arabic'];
                    $items3 = ['Profile', 'Logout'];
                    $links = ['login', 'register'];
                    $links2 = ['english', 'arabic'];
                    $links3 = ['dash.myprofile', 'logout'];
                @endphp
                @auth
                    <x-dropdown :items="$items3" label="My account" :links="$links3"/>
                @else
                    <x-dropdown :items="$items" label="My account" :links="$links"/>
                @endauth
                <div class="dropdown" style="background-color: transparent">
                    <label tabindex="0" class="btn text-nowrap lg:text-xs text-xs hover:text-regal-brown py-0 font-normal m-1" style="background-color: transparent; border:none;">
                        Languages<span class="material-symbols-outlined">arrow_drop_down</span>
                    </label>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="#">English</a></li>
                        <li><a href="#">Arabic</a></li>
                    </ul>
                </div>
                <a href="#" class="text-xs mx-2 lg:text-md hover:text-regal-brown transition-all duration-500 py-0">Contact Us</a>
            </div>
        </div>
    </nav>

    <!-- Main Navbar -->
    <nav id="menu" class="bg-gray-50 transition-all duration-1000 dark:bg-gray-700">
        <div class="max-w-screen-xl flex justify-between items-center px-4 py-7 mx-auto" id="navBottom">
            <a href="{{ route('welcome') }}" class="flex items-center">
                <img src="{{ asset('assets/images/logo.png') }}" class="h-8 mr-3 hover:scale-150 transition-all duration-500 rounded-full" alt="Flowbite Logo" />
                <span class="self-center opacity-75 text-sm lg:text-xl font-semibold whitespace-nowrap dark:text-white">Stanissk Store</span>
            </a>
            <div class=" items-center hidden lg:flex" id="categories">
                <ul class="flex flex-row font-medium mt-0 mr-6 space-x-8 text-sm">
                    <li>
                        <a href="{{ route('welcome') }}" class="text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500 category" aria-current="page">Home</a>
                    </li>
                    <li>
                        <button id="phone_btn" class="text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500 category">Phones</button>
                    </li>
                    <li>
                        <button id="accessory_btn" class="text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500 category">Accessories</button>
                    </li>
                    <li>
                        <button id="electronic_btn" class="text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500 category">Electronics</button>
                    </li>
                </ul>
            </div>
            <div class="hidden" id="searchBar">
                <x-SearchBar :categories="$categories"/>
                <span class="material-symbols-outlined text-3xl ml-10 hover:text-regal-brown transition-all duration-500 cursor-pointer" id="close">close</span>
            </div>
            <div class="flex items-center" id="buttons">
                <ul class="flex flex-row font-medium mt-0 mr-6 space-x-8 text-sm">
                    <li>
                        <label for="voice-search" class="sr-only">Search</label>
                        <button id="searchbtn" type="button" class="inline-flex ml-2 text-sm bg-transparent rounded-lg focus:outline-none dark:bg-regal-brown dark:hover:bg-regal-700brown dark:focus:ring-amber-700">
                            <span class="material-symbols-outlined cursor-pointer hover:text-regal-brown transition-all duration-500" style="font-variation-settings:'FILL' 0,'wght' 300,'GRAD' 0,'opsz' 20">search</span>
                        </button>
                    </li>
                    @auth
                        <li>
                            <div class="dropdown dropdown-end" style="background-color: transparent">
                                <div tabindex="0" class="relative inline-block" style="background-color: transparent; border:none;">
                                    <div class="w-4 h-4 cursor-pointer bg-regal-brown text-white rounded-full flex items-center justify-center text-xs font-semibold absolute -top-1 -right-1">4</div>
                                    <span class="material-symbols-outlined cursor-pointer hover:text-regal-brown transition-all duration-500" style="font-variation-settings:'FILL' 0,'wght' 300,'GRAD' 0,'opsz' 20">notifications</span>
                                </div>
                                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-80">
                                    <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">Notifications</div>
                                    <li>
                                        <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <div class="flex-shrink-0">
                                                <img class="rounded-full w-11 h-11" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                                                <div class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-regal-brown border border-white rounded-full dark:border-gray-800">
                                                    <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                                        <path d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z"/>
                                                        <path d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="w-full pl-3">
                                                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">New message from <span class="font-semibold text-gray-900 dark:text-white">Jese Leos</span>: "Hey, what's up? All set for the presentation?"</div>
                                                <div class="text-xs text-regal-brown dark:text-regal-amber-">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
            <button id="hamburger" class="md:hidden block text-gray-900 dark:text-white">
                <svg class="w-6 h-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
</nav>

<!-- Mobile Menu -->
<div id="mobileMenu" class="hidden md:hidden">
    <ul class="px-4 pt-4 pb-4 space-y-4 text-sm">
        <li><a href="{{ route('welcome') }}" class="block text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500">Home</a></li>
        <li><button id="phone_btn_mobile" class="block text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500">Phones</button></li>
        <li><button id="accessory_btn_mobile" class="block text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500">Accessories</button></li>
        <li><button id="electronic_btn_mobile" class="block text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500">Electronics</button></li>
    </ul>
    <div class="px-4 py-4">
        <button id="searchbtn_mobile" type="button" class="inline-flex w-full text-sm bg-transparent rounded-lg focus:outline-none dark:bg-regal-brown dark:hover:bg-regal-700brown dark:focus:ring-amber-700">
            <span class="material-symbols-outlined cursor-pointer hover:text-regal-brown transition-all duration-500" style="font-variation-settings:'FILL' 0,'wght' 300,'GRAD' 0,'opsz' 20">search</span>
        </button>
    </div>
    @auth
    <ul class="px-4 pt-4 pb-4 space-y-4 text-sm">
        <li class="relative">
            <div class="relative inline-block w-full">
                <div class="w-4 h-4 cursor-pointer bg-regal-brown text-white rounded-full flex items-center justify-center text-xs font-semibold absolute -top-1 -right-1">4</div>
                <span class="material-symbols-outlined cursor-pointer hover:text-regal-brown transition-all duration-500" style="font-variation-settings:'FILL' 0,'wght' 300,'GRAD' 0,'opsz' 20">notifications</span>
            </div>
            <ul class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-80 mt-2">
                <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">Notifications</div>
                <li>
                    <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <div class="flex-shrink-0">
                            <img class="rounded-full w-11 h-11" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                            <div class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-regal-brown border border-white rounded-full dark:border-gray-800">
                                <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                    <path d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z"/>
                                    <path d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="w-full pl-3">
                            <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">New message from <span class="font-semibold text-gray-900 dark:text-white">Jese Leos</span>: "Hey, what's up? All set for the presentation?"</div>
                            <div class="text-xs text-regal-brown dark:text-regal-amber-">
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    @endauth
</div>

<script>
    document.getElementById('hamburger').onclick = function() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
    };

    document.getElementById('searchbtn').onclick = function() {
        document.getElementById('searchBar').classList.toggle('hidden');
    };

    document.getElementById('searchbtn_mobile').onclick = function() {
        document.getElementById('searchBar').classList.toggle('hidden');
    };

    document.getElementById('close').onclick = function() {
        document.getElementById('searchBar').classList.add('hidden');
    };
</script>
