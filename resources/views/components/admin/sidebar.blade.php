<div class="drawer z-50" data-theme="coffee">
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
            <!-- Collapsible navigation container -->
            <div
              class="!visible hidden flex-grow basis-[100%] items-center lg:!flex lg:basis-auto"
              >
              <!-- Logo -->
              <a
                class="mb-4 ml-2 mr-5 mt-3 flex items-center text-neutral-900 hover:text-neutral-900 focus:text-neutral-900 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400 lg:mb-0 lg:mt-0"
                href="#">
                <img
                  src="{{asset('assets/images/logo.png')}}" 
                  style="height: 35px"
                  alt="TE Logo"
                  class=" rounded-full"
                  />
              </a>
              <!-- Left navigation links -->
              <!-- <ul
                class="list-style-none mr-auto flex flex-col pl-0 lg:flex-row"
              >
                <li class="mb-4 lg:mb-0 lg:pr-2" >
                  <a
                    class="text-slite-400  transition duration-200 hover:text-neutral-700 hover:ease-in-out focus:text-neutral-700 disabled:text-black/30 motion-reduce:transition-none dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 lg:px-2 [&.active]:text-black/90 dark:[&.active]:text-zinc-400"
                    href="#"
                    >Dashboard</a
                  >
                </li>
              </ul> -->
            </div>
          </div>
        </div>
  
        <!-- Sidebar content here -->
        <li class=" mt-5">
        <a
          href="{{  Auth::user()->hasRole('user')  ? route('user') : route('admin') }}"
          class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
          data-te-sidenav-link-ref>
          <span class="material-symbols-outlined text-regal-brown">
            dashboard
          </span>
          <span>Dashboard</span>
        </a>
        </li>
        <li>
        <a
          class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
          href="{{route('product.index')}}"
          data-te-sidenav-link-ref>
          <span class="material-symbols-outlined text-regal-brown">
            production_quantity_limits
          </span>
          <span>Products</span>
        </a>
        </li>  
        <li>
        <a
          href="{{route('dashboard.orders')}}"
          class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
          data-te-sidenav-link-ref>
          <span class="material-symbols-outlined text-regal-brown">
          draft_orders
          </span>
          <span>Orders</span>
        </a>
        </li>
        <li>
          <a
            href="{{route('dashboard.Customers')}}"
            class="flex h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-inherit hover:outline-none focus:bg-slate-50 focus:text-inherit focus:outline-none active:bg-slate-50 active:text-inherit active:outline-none data-[te-sidenav-state-active]:text-inherit data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
            data-te-sidenav-link-ref>
            <span class="material-symbols-outlined text-regal-brown">
              support_agent
              </span>
            <span>Customers</span>
          </a>
          </li>
      </ul>
    </div>
</div>
