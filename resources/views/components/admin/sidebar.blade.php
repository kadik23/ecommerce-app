<div dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="drawer z-50">
    <input id="my-drawer" type="checkbox" class="drawer-toggle " />
    <div class="drawer-side">
      <label for="my-drawer" class="drawer-overlay"></label>
      <ul class="menu p-4 w-80 min-h-full bg-base-200 text-base-content">
        <div class="dark:hover:bg-none ">
          <div class="flex w-full flex-wrap items-center justify-between px-3">
  
            <!-- Toggler -->
            <div class="drawer-content">
              <label for="my-drawer" class="btn min-h-fit  h-8 border-none bg-regal-brown px-2 py-0  hover:bg-amber-700 active:bg-regal-brown drawer-button">
                <span class="block [&>svg]:h-5 [&>svg]:w-5 [&>svg]:text-white">
                  <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24" fill="currentColor"
                  class="h-5 w-5">
                    <path fill-rule="evenodd" d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                  </svg>
                </span>
              </label>
            </div>
            <!-- Logo -->
            <div class="!visible hidden flex-grow basis-[100%] items-center lg:!flex lg:basis-auto">
              <a class="mb-4 ml-2 mr-5 mt-3 flex items-center text-neutral-900 dark:text-neutral-200 lg:mb-0 lg:mt-0" href="#">
                <img src="{{ asset('assets/images/logo.png') }}" style="height: 35px" alt="Logo" class="rounded-full" />
              </a>
            </div>
          </div>
        </div>

        <!-- Mobile controls (Theme & Language) -->
        <li class="mt-4">
          <div class="relative flex lg:hidden flex-col items-start">
            <ul class="px-1">
              <!-- Dark mode choices --> 
              <li>
                <details class="dropdown">
                  <summary class="m-1 btn btn-ghost dark:text-slate-100 bg-transparent border-none"> 
                    <span class="material-symbols-outlined dark:text-slate-50">dark_mode</span>
                  </summary>
                  <ul class="p-2 shadow menu dropdown-content z-[1] dark:text-slate-900 bg-base-100 rounded-box w-28">
                    <li>    
                      <a class="theme-toggle-light block w-full bg-transparent px-3 py-2 text-sm font-normal text-gray-700 hover:bg-gray-100 dark:text-gray-500 dark:hover:bg-gray-600" href="#">
                        <span class="me-2">☀️</span> Light
                      </a>
                    </li>
                    <li>  
                      <a class="theme-toggle-dark block w-full bg-transparent px-3 py-2 text-sm font-normal text-gray-700 hover:bg-gray-100 dark:text-gray-500 dark:hover:bg-gray-600" href="#">
                        <span class="me-2">🌙</span> Dark
                      </a> 
                    </li>
                  </ul>
                </details>
              </li>
              <!-- language select -->
              <li >  
                <details class="dropdown dropdown-end ">
                  <summary class="dark:text-slate-100 m-1 btn bg-transparent border-none">
                    @if(app()->getLocale() == 'ar')
                      <img width="24" height="24" src="https://img.icons8.com/fluency/48/saudi-arabia.png" alt="saudi-arabia" />
                      <span class="ml-1">{{ t('admin.navbar.arabic') }}</span> 
                    @else
                      <img width="24" height="24" src="https://img.icons8.com/fluency/48/great-britain-circular.png" alt="great-britain-circular" />
                      <span class="ml-1">{{ t('admin.navbar.english') }}</span> 
                    @endif
                  </summary>
                  <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-32">
                    <li>
                      <a href="{{ route('lang.switch', 'en') }}">
                        <img width="24" height="24" src="https://img.icons8.com/fluency/48/great-britain-circular.png" alt="great-britain-circular" />
                        <span class="ml-1">{{ t('admin.navbar.english') }}</span> 
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('lang.switch', 'ar') }}">
                        <img width="24" height="24" src="https://img.icons8.com/fluency/48/saudi-arabia.png" alt="saudi-arabia" />
                        <span class="ml-1">{{ t('admin.navbar.arabic') }}</span> 
                      </a>
                    </li>  
                  </ul>
                </details>
              </li>        
            </ul>
          </div>  
        </li>

        <hr class="border lg:hidden mt-4 border-gray-300">

        <!-- Navigation Routes List -->
        @php
            $sidebarNavItems = [
                [
                    'route' => Auth::user()->hasRole('user') ? route('user') : route('admin'),
                    'icon' => 'dashboard',
                    'label' => t('admin.sidebar.dashboard'),
                    'routeName' => Auth::user()->hasRole('user') ? 'user' : 'admin',
                ],
                [
                    'route' => route('product.index'),
                    'icon' => 'production_quantity_limits',
                    'label' => t('admin.sidebar.products'),
                    'routeName' => 'product.index',
                ],
                [
                    'route' => route('dashboard.orders'),
                    'icon' => 'draft_orders',
                    'label' => t('admin.sidebar.orders'),
                    'routeName' => 'dashboard.orders',
                ],
                [
                    'route' => route('dashboard.Customers'),
                    'icon' => 'support_agent',
                    'label' => t('admin.sidebar.customers'),
                    'routeName' => 'dashboard.Customers',
                ],
                [
                    'route' => route('dashboard.contactMessages'),
                    'icon' => 'mail',
                    'label' => t('admin.sidebar.contact_messages'),
                    'routeName' => 'dashboard.contactMessages',
                ],
            ];
        @endphp

        @foreach($sidebarNavItems as $item)
          <li class="{{ $loop->first ? 'mt-5' : '' }}">
            <a
              href="{{ $item['route'] }}"
              class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit focus:bg-slate-50 focus:text-inherit active:bg-slate-50 dark:text-gray-300 dark:hover:bg-white/10 {{ request()->routeIs($item['routeName']) ? 'bg-slate-100 dark:bg-white/10 font-bold text-regal-brown dark:text-amber-400' : '' }}"
              data-te-sidenav-link-ref>
              <span class="material-symbols-outlined text-regal-brown me-3">
                {{ $item['icon'] }}
              </span>
              <span>{{ $item['label'] }}</span>
            </a>
          </li>
        @endforeach

        <hr class="border mt-4 border-gray-300 lg:hidden">

        <!-- Mobile Settings & Logout -->
        <li class="lg:hidden">
          <a href="{{ route('dash.myprofile') }}" class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-white/10">
            <span class="material-symbols-outlined text-regal-brown me-3">settings</span>
            <span>{{ t('admin.sidebar.settings') }}</span>
          </a>
        </li>
        <li class="lg:hidden">
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();" class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 dark:text-gray-300 hover:bg-slate-50 dark:hover:bg-white/10">
            <span class="material-symbols-outlined text-regal-brown me-3">logout</span>
            <span>{{ t('admin.sidebar.logout') }}</span>
          </a>
          <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
          </form>
        </li>
      </ul>
    </div>
</div>
