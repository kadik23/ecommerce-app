@extends('layouts.dashboard')

@section('content1')

<x-admin.titleCard :title="$indexTitle" />


<div class="flex justify-between">

    <div class=" m-3 w-2/3 ">
        <div class=" w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
            <h5 class="inline-block text-xl font-bold my-3 text-gray-900 dark:text-white">Users Statistic</h5> 
            <div class="flex justify-between">
                <div>
                    <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">32.4k</h5>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Users this week</p>
                </div>
                <div
                    class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                    12%
                    <svg class="w-3 h-3 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
                    </svg>
                </div>
            </div>
            <div id="area-chart"></div>
            <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
            <div class="flex justify-between items-center pt-5">
                <!-- Button -->
                <button
                    id="dropdownDefaultButton"
                    data-dropdown-toggle="lastDaysdropdown"
                    data-dropdown-placement="bottom"
                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                    type="button">
                    Last 7 days
                    <svg class="w-2.5 m-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
                    </li>
                    </ul>
                </div>
                <a
                href="#"
                class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-regal-brown hover:text-amber-700 dark:hover:text-amber-700  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                Users Report
                <svg class="w-2.5 h-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                </a>
            </div>
        </div>
    </div>
    </div>

    
    <div class="inline-block ">
        <div class="m-3 p-2 flex flex-col bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="inline-block text-xl font-bold text-gray-900 dark:text-white">Total Report</h5>
            <div class="flex flex-wrap text-center justify-around items-center bg-gray-50 rounded-md my-2 p-2">
                <img class="w-8" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAABPklEQVR4nO2WzUrEMBRGbwdN3kz09RTXDQyIP7sRndl0pmVw4ajbvoHaJ6jLI0nXSi2dNDL3wIXQJJS0h+9GRFEU5eChNGdU5pLSvlGaDyr7FcqP/TM/t7GnSX4oKrOksvSsR0kNCrPrfYDC7CQ1cAJ3s1dWxxVrW1OahtK2XZmGja3DnF/jBEkNbrKncIg+dTvbSmpQmOdQi6OC66xmnn3ipA3lx1dZHebW3brkUoE+Ci3/oFDsVGBshWKnAmMrFDsVGF2hyKnAHhQaPxVivo+xf2ns96EK/WOFGNAASUWhoQ2QVFJoaAMkFYWGNkCSUSjyvn0oFHXfNAqNuO9HVKGFKtSoQmgKWU0htJGttJGhd6H5Qd6FnDz0vt7mcj/Vvl/ByQm5XODEn/qdXNpQ3fgFJ+d+zdT7FEVRZHK+AcKVXlXG4vExAAAAAElFTkSuQmCC">
                <h5 class="inline-block text-xl font-bold text-gray-900 dark:text-white">Total profits </h5>
                <span>$150 </span>
            </div>
            <div class="flex flex-wrap text-center justify-around items-center bg-gray-50 rounded-md p-2">
                <img class="w-8" src="data:image/png;base64,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">
                <h5 class="inline-block mr-6 text-xl font-bold text-gray-900 dark:text-white">Revenue</h5>
                <span >$680 </span>
            </div>
        </div>

        <div class=" m-3 max-w-md mt-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Customers</h5>
                <a href="{{route('dashboard.Customers')}}" class="text-sm font-medium text-regal-brown hover:underline dark:text-regal-brown">
                    View all
                </a>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Neil image">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Neil Sims
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    email@windster.com
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                $320
                            </div>
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Bonnie Green
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    email@windster.com
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                $3467
                            </div>
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-2.jpg" alt="Michael image">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Michael Gough
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    email@windster.com
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                $67
                            </div>
                        </div>
                    </li>
                
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection
