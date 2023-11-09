<nav  class="bg-white  border-gray-200 tr dark:bg-gray-900 ">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 ">
        <div class="flex items-center">
            <p class="mr-6  text-sm flex items-center text-gray-500 dark:text-white">
                <span   class="material-symbols-outlined text-regal-brown" style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 20">call</span>
                <span>Free Support</span> (213) 0798816073
            </p>
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
            @Auth
            <x-dropdown :items="$items3" label="My account"  :links="$links3"/>
            @else
            <x-dropdown :items="$items" label="My account"  :links="$links"/>
            @endauth
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
<nav id="menu" class="bg-gray-50 transition-all duration-1000 dark:bg-gray-700">
    <div class="max-w-screen-xl flex justify-between px-4 py-7 mx-auto" id="navBottom">
        <a href="{{route('welcome')}}" class="flex items-center">
            <img src="{{asset('assets/images/logo.png')}}" class="h-8 mr-3 hover:scale-150 transition-all duration-500  rounded-full" alt="Flowbite Logo" />
            <span class="self-center opacity-75 text-xl font-semibold whitespace-nowrap dark:text-white">Stanissk Store</span>
        </a>
        <div class="flex items-center" id="categories" >
            <ul class="flex flex-row font-medium mt-0 mr-6 space-x-8 text-sm" >
                <li>
                    <a href="{{route('welcome')}}" class="text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500 category" aria-current="page">Home</a>
                </li>
                <li>
                    <button  id="phone_btn" class="text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500 category">Phones</button>
                </li>
                <li>
                    <button id="accessory_btn" class="text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500 category">Accesoires</button>
                </li>
                <li>
                    <button id="electronic_btn"  class="text-gray-900 dark:text-white hover:text-regal-brown transition-all duration-500 category">Electronics</button>
                </li>
            </ul>
        </div>
        <div class="hidden " id="searchBar">
            <x-SearchBar :categories="$categories"/>  
            <span class="material-symbols-outlined text-3xl ml-10 hover:text-regal-brown transition-all duration-500 cursor-pointer" id="close">
                close
            </span>
        </div>
        <div class="flex items-center" id="buttons">
            <ul class="flex flex-row font-medium mt-0 mr-6 space-x-8 text-sm">
                <li>                 
                    <label for="voice-search" class="sr-only">Search</label>
                    <button id="searchbtn" type="button" class="inline-flex  ml-2 text-sm  bg-transparent rounded-lg focus:outline-none  dark:bg-regal-brown dark:hover:bg-regal-700brown dark:focus:ring-amber-700">
                        <span class="material-symbols-outlined  cursor-pointer hover:text-regal-brown transition-all duration-500" style="font-variation-settings:'FILL' 0,'wght' 300,'GRAD' 0,'opsz' 20">
                            search
                        </span> 
                    </button>                   
                </li>
                @Auth
                <li>         
                    <div class="dropdown dropdown-end" style="background-color: transparent">
                        
                            <div tabindex="0" class="relative  inline-block" style="background-color: transparent; border:none;" >
                                <div class="w-4 h-4 cursor-pointer  bg-regal-brown text-white rounded-full flex items-center justify-center text-xs font-semibold absolute -top-1 -right-1">
                                    4
                                </div>
                                <span class="material-symbols-outlined cursor-pointer hover:text-regal-brown transition-all duration-500" style="font-variation-settings:'FILL' 0,'wght' 300,'GRAD' 0,'opsz' 20">
                                    notifications
                                </span> 
                            </div> 


                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-80  ">
                            <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                                Notifications
                            </div>
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
                                        <div class="text-xs text-regal-brown dark:text-regal-amber-700">a few moments ago</div>
                                    </div>
                                  </a>
                            </li>    
                            <li>
                                <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <div class="flex-shrink-0">
                                        <img class="rounded-full w-11 h-11" src="/docs/images/people/profile-picture-2.jpg" alt="Joseph image">
                                        <div class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-gray-900 border border-white rounded-full dark:border-gray-800">
                                        <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z"/>
                                        </svg>
                                        </div>
                                    </div>
                                    <div class="w-full pl-3">
                                        <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400"><span class="font-semibold text-gray-900 dark:text-white">Joseph Mcfall</span> and <span class="font-medium text-gray-900 dark:text-white">5 others</span> started following you.</div>
                                        <div class="text-xs text-regal-brown dark:text-regal-amber-700">10 minutes ago</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <div class="flex-shrink-0">
                                        <img class="rounded-full w-11 h-11" src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">
                                        <div class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-red-600 border border-white rounded-full dark:border-gray-800">
                                        <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z"/>
                                        </svg>
                                        </div>
                                    </div>
                                    <div class="w-full pl-3">
                                        <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400"><span class="font-semibold text-gray-900 dark:text-white">Bonnie Green</span> and <span class="font-medium text-gray-900 dark:text-white">141 others</span> love your story. See it and view more stories.</div>
                                        <div class="text-xs text-regal-brown dark:text-regal-amber-700">44 minutes ago</div>
                                    </div>
                                </a>
                            </li>    
                            <a href="#" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                                <div class="inline-flex items-center ">
                                    <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                        <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                    </svg>
                                        View all
                                </div>
                            </a>
                        </ul>
                    </div>
                </li>
                <li>         
                    <div class="dropdown dropdown-end" style="background-color: transparent">
                        
                            <div tabindex="0" class="relative  inline-block" style="background-color: transparent; border:none;" >
                                <div class="w-4 h-4 cursor-pointer  bg-regal-brown text-white rounded-full flex items-center justify-center text-xs font-semibold absolute -top-1 -right-1">
                                    5 
                                </div>
                                <span class="material-symbols-outlined cursor-pointer hover:text-regal-brown transition-all duration-500" style="font-variation-settings:'FILL' 0,'wght' 300,'GRAD' 0,'opsz' 20">
                                    favorite
                                </span> 
                            </div> 


                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-80 ">
                            <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                                Favorite
                            </div>
                            <li>
                                <a href="#" class="flex px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <div class="w-32 overflow-hidden">
                                        <img class="object-cover h-20" src="{{asset('assets/images/products/1695233140.jpg')}}" alt="Bonnie image">

                                    </div>
                                    <div class="w-full pl-3">
                                        <div class="text-gray-500 text-md mb-1 dark:text-gray-400"><span class="font-bold text-gray-900 dark:text-white">Samsung S32</div>
                                            <div class="text-gray-500 text-sm mb-1 dark:text-gray-400"><span class="opacity-80 text-gray-900 dark:text-white">admin</div>
                                        <div class="text-lg text-bold text-regal-brown dark:text-regal-amber-700">13$</div>
                                    </div>
                                </a>
                            </li> 
                            <hr class="opacity-70 p-0">
                            <li>
                                <a href="#" class="flex px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <div class="w-32 overflow-hidden">
                                        <img class="object-cover h-20" src="{{asset('assets/images/products/1695233140.jpg')}}" alt="Bonnie image">

                                    </div>
                                    <div class="w-full pl-3">
                                        <div class="text-gray-500 text-md mb-1 dark:text-gray-400"><span class="font-bold text-gray-900 dark:text-white">Samsung A14</div>
                                            <div class="text-gray-500 text-sm mb-1 dark:text-gray-400"><span class="opacity-80 text-gray-900 dark:text-white">admin</div>
                                        <div class="text-lg text-bold text-regal-brown dark:text-regal-amber-700">300$</div>
                                    </div>
                                </a>
                            </li>
                            <a href="#" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                                <div class="inline-flex items-center ">
                                    <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                        <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                    </svg>
                                        View all
                                </div>
                            </a>
                        </ul>
                    </div>

                
                </li>
                <li>         
                    <div class="dropdown dropdown-notifications dropdown-bottom dropdown-left" style="background-color: transparent">
                        
                            <div tabindex="0"  onclick="resetToZero()" data-toggle="collapse" class="relative   inline-block" style="background-color: transparent; border:none;" >
                                <div data-count="{{Count($carts)}}"  class="w-4 h-4 notif-count cursor-pointer  bg-regal-brown text-white rounded-full flex items-center justify-center text-xs font-semibold absolute -top-1 -right-1">
                                    {{Count($carts)}}
                                </div>
                                <span class="material-symbols-outlined cursor-pointer hover:text-regal-brown transition-all duration-500" style="font-variation-settings:'FILL' 0,'wght' 300,'GRAD' 0,'opsz' 20">
                                    shopping_bag
                                </span> 
                            </div> 


                        <ul tabindex="0" id="scrollable-container" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box " style="width: 350px">
                            <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                                Cart                      
                            </div>
                            @if(isset($carts))
                                @forEach($carts AS $Cart)
                                <li class="flex flex-row items-center cart{{$Cart->id}}">
                                    <a href="#" class="flex px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <div class="w-32 overflow-hidden">
                                            <img class="object-cover h-20" src="{{ asset('assets/images/products/' . $Cart->profileImage) }}" alt="Bonnie image">

                                        </div>
                                        <div class="w-full pl-3">
                                            <div class="text-gray-500 text-md mb-1 dark:text-gray-400"><span class="font-bold text-gray-900 dark:text-white">{{$Cart->name}}</div>
                                                <div class="text-gray-500 text-sm mb-1 dark:text-gray-400"><span class="opacity-80 text-gray-900 dark:text-white">{{$Cart->user_id}}</div>
                                            <div class="text-lg text-bold text-regal-brown dark:text-regal-amber-700">{{$Cart->price}}</div>
                                        </div>
                                    </a>
                                    <a href="" product_id={{$Cart->id}} class="delete_cart hover:bg-transparent"> 
                                        <span class=" ml-2 material-symbols-outlined cursor-pointer text-regal-brown hover:bg-transparent hover:text-amber-700">
                                            close
                                        </span>
                                    </a>
                                </li> 
                                @endforeach
                            @endif
                            <hr class="opacity-70 p-0">
                            <li>
                                <a href="{{route('cart.index')}}" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                                    <div class="inline-flex items-center ">
                                        <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                            <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                        </svg>
                                            View all
                                    </div>
                                </a>
                            </li>
                        </ul>
                      </div>    
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<script>
    // when click search botton appear search bar and reverse
    navBottom = document.getElementById('navBottom')
    document.getElementById('searchbtn').addEventListener("click",()=>{
        document.getElementById('searchBar').classList.add("flex")
        document.getElementById('searchBar').classList.remove("hidden")
        document.getElementById('buttons').style.visibility = "hidden"
        document.getElementById('categories').style.display = "none"
        navBottom.classList.remove("py-7")
        navBottom.classList.add("py-6")
        })
    document.getElementById('close').addEventListener("click",()=>{
        document.getElementById('searchBar').classList.remove("flex")
        document.getElementById('searchBar').classList.add("hidden")
        document.getElementById('buttons').style.visibility = "visible"
        document.getElementById('categories').style.display = "flex"
        navBottom.classList.add("py-7")
        navBottom.classList.remove("py-6")
    })

    
    // fixe menu navbar when i scroll bottom
    window.addEventListener('scroll', () => {
    const menu = document.getElementById('menu');
    const scrollThreshold = 200; // Adjust this threshold as needed
    if (window.scrollY >= scrollThreshold) {
        console.log(window.scrollY)
        // Add a CSS class to fix the menu
        if (window.scrollY == scrollThreshold) 
        menu.classList.add('nav_animation');
        setTimeout(() => {
            menu.classList.add('transform');
            menu.classList.add('translate-y-0');
            menu.classList.add('top-0');
            menu.classList.add('z-50');
            menu.classList.add('fixed');
            menu.classList.add('w-full');
            menu.classList.add('bg-black');
            menu.classList.remove('nav_animation');
        }, 500);
    } else {
        // Remove the class when scrolling back up
        menu.classList.remove('nav_animation');
        menu.classList.remove('translate-y-0');
        menu.classList.remove('top-0');
        menu.classList.remove('z-50');
        menu.classList.remove('fixed');
        menu.classList.remove('w-full');
        menu.classList.remove('transform');
        menu.classList.remove('bg-black');
    }
});

</script>
