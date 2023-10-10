

<div data-theme="dark"  class="navbar fixed z-40 bg-[#FBFBFB]   justify-between py-0 shadow-md shadow-black/5 dark:bg-neutral-600 dark:shadow-black/10">
    <!-- left elements -->
    <div class="flex flex-wrap items-center  justify-start px-3">
      <!-- Toggler -->
      <div class="drawer-content">
      <label for="my-drawer" class="btn min-h-fit  h-8 border-none bg-regal-brown px-2 py-0  hover:bg-amber-700 active:bg-regal-brown drawer-button">
        <span class="block [&>svg]:h-5 [&>s vg]:w-5 [&>svg]:text-white">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="h-5 w-5">
            <path
              fill-rule="evenodd"
              d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
              clip-rule="evenodd" />
          </svg>
        </span>
      </label>
    </div> 
      <a class="mb-4 ml-2 mr-5 mt-3 flex items-center text-neutral-900 hover:text-neutral-900 focus:text-neutral-900 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400 lg:mb-0 lg:mt-0">
             <img
            src="{{asset('assets/images/logo.png')}}"
            style="height: 35px"
            alt="TE Logo"
            class=" rounded-full hover:scale-105 "
            />
      </a>
  
      <div
        class="!visible hidden flex-grow basis-[100%] items-center lg:!flex lg:basis-auto"
        id="navbarSupportedContent1"
      >
        <!-- Left navigation links -->
        <ul
          class="list-style-none mr-auto flex flex-col pl-0 lg:flex-row"
          >
          <li class="mb-4 lg:mb-0 lg:pr-2">
            <!-- Dashboard link -->
            <a
              class="text-neutral-500  transition duration-200 hover:text-neutral-700 hover:ease-in-out focus:text-neutral-700 disabled:text-black/30 motion-reduce:transition-none dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 lg:px-2 [&.active]:text-black/90 dark:[&.active]:text-zinc-400"
              href="{{  Auth::user()->hasRole('user')  ? route('user') : route('admin') }}"
              
              >Dashboard</a
            >
          </li>
        </ul>
      </div>
    </div>
    <!-- Right elements -->
    <div class="relative flex flex-wrap items-center ">
      <ul class="menu menu-horizontal items-center px-1">
  
        <!-- dark mode choices --> 
        <li>
          <details class="dropdown">
            <summary class="m-1 btn dark:text-slate-100 bg-transparent border-none "> 
              <a
                class="hidden-arrow px-0 py-0 flex items-center whitespace-nowrap transition duration-150 ease-in-out motion-reduce:transition-none"
                href="#"
              >
              <!-- dark mode Icon -->
                <span class="material-symbols-outlined  dark:text-slate-50" >
                  dark_mode
                </span>
              </a>
            </summary>
            <ul class="p-2 shadow menu dropdown-content z-[1] dark:text-slate-900 bg-base-100 rounded-box w-28">
              <li>    
                <a
                  class="block w-full whitespace-nowrap bg-transparent px-3 py-2 text-sm font-normal text-gray-700 hover:bg-gray-100 focus:bg-gray-200 focus:outline-none active:text-zinc-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-gray-400 dark:text-gray-500 dark:hover:bg-gray-600 "
                  href="#"
                >
                <div class="pointer-events-none">
                  <div class="inline-block w-[24px] text-center">
                      <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="currentColor"
                      class="inline-block h-6 w-6">
                      <path
                          d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z" />
                      </svg>
                  </div>
                  <span >Light</span>
                </div>
                </a>
              </li>
              <li>  
                <a
                  id="theme-switcher"
                  class="block w-full whitespace-nowrap bg-transparent px-3 py-2 text-sm font-normal text-gray-700 hover:bg-gray-100 focus:bg-gray-200 focus:outline-none active:text-zinc-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent  disabled:text-gray-400 dark:text-gray-500 dark:hover:bg-gray-600 "
                  href="#"
                  >
                  <div class="pointer-events-none">
                  <div
                      class="inline-block w-[24px] text-center"
                      data-theme-icon="dark">
                      <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="currentColor"
                      class="inline-block h-6 w-6">
                      <path
                          fill-rule="evenodd"
                          d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z"
                          clip-rule="evenodd" />
                      </svg>
                  </div>
                  <span data-theme-name="dark">Dark</span>
                  </div>
              </a> 
              </li>
            </ul>
          </details>
          <!--end dark mode choices -->
        </li>
  
        <!-- language select -->
        <li >  
          <details class="dropdown dropdown-end ">
              <summary class=" dark:text-slate-100 m-1 btn bg-transparent border-none "> <!-- User avatar -->
                <img width="24" height="24" src="https://img.icons8.com/fluency/48/great-britain-circular.png" alt="great-britain-circular" />
                <span class="ml-1">English</span> 
              </summary>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-32">
              <!--profile dropdown menu items  -->
              <li>
                <router-link :to="{name: 'login'}" href="#">
                  <img width="24" height="24" src="https://img.icons8.com/fluency/48/great-britain-circular.png" alt="great-britain-circular" />
                  <span class="ml-1">English</span> 
                </router-link>
              </li>
              <!-- logout dropdown menu items -->
              <li>
                <router-link :to="{name: 'login'}" href="#">
                  <img width="24" height="24"  src="https://img.icons8.com/fluency/48/saudi-arabia.png" alt="saudi-arabia" />
                  <span class="ml-1">Arabic</span> 
                </router-link>
              </li>  
            </ul>
            </details>
        </li>
  
        <!-- profile -->
        <li>
            <details class="dropdown dropdown-end">
              <summary class="dark:text-slate-100 m-1 btn bg-transparent border-none hover:bg-transparent"> <!-- User avatar -->
                <img
                  src="https://tecdn.b-cdn.net/img/new/avatars/2.jpg"
                  class="rounded-full  "
                  style="height: 25px; width: 25px"
                  alt=""
                />
              </summary>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-32">
              <!--profile dropdown menu items  -->
              <li>
                    <a class="dropdown-item " href="{{ route('dash.myprofile') }}">  
                        <span class="[&>svg]:w-5">                  
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        <span>
                          {{ __('Profile') }}
                        </span>                    
                    </a>
              </li>
              <!-- logout dropdown menu items -->
              <li>
                  {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->username }}
                  </a> --}}

                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item flex flex-2 justify-between " href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          <span class="[&>svg]:w-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                          </span>
                          <span class="ml-2">
                          {{ __('Logout') }}
                        </span>
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </div>

              </li>  
            </ul>
            </details>
        </li>
  
      </ul>
    </div>  
  </div>
