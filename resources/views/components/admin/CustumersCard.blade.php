<li class="flex flex-wrap md:flex-nowrap justify-between py-3 sm:py-4">
    <div class="flex-shrink-0 w-16 lg:w-36 p-2">
        <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Neil image">
    </div>
    <div class="px-4 lg:px-8 w-full md:w-auto">
        <p class="text-sm lg:text-lg font-medium text-gray-900 truncate dark:text-white">
            {{$fullname}}
        </p>
    </div>
    <div class="p-2 w-full md:w-auto">
        <p class="text-sm lg:text-lg text-gray-900 font-medium truncate dark:text-gray-400">
            {{$email}}
        </p>
    </div>
    <div class="p-2 text-sm lg:text-lg text-gray-900 font-medium truncate dark:text-gray-400 w-full md:w-auto">
        ${{$revenue}}
    </div>
    <div class="p-2 text-sm lg:text-lg text-gray-900 font-medium truncate dark:text-gray-400 w-full md:w-auto">
        {{$country}}
    </div>
</li>
