@if((Auth::check()) && (Auth::user()->hasRole('admin')))
<form method="GET" action="{{route('product.show', $categoryS??'categories')}}">
@else
<form method="GET" action="{{route('user.product.show')}}">
@endif
    @csrf       
    <div class="flex ">
        <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
       
        <select name="category"  id="category" class="flex-shrink-0 active:border-none focus:border-none ml-3 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600">
            <option value="All categories" selected>All categories</option>
            @foreach($categories AS $category)
            <option value="{{$category->name}}" class="opt p-16">
                {{$category->name}}
            </option>
            @endforeach
        </select>
        
    
        <div class="relative w-96 hover:opacity-90 transition-opacity duration-500">
            <input type="search" name="search" id="search-dropdown" class="block  p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-regal-brown focus:border-regal-brown dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-regal-brown" placeholder="Search Phones, Accesoires, Electronics ..." >
            <button type="submit"  class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-regal-brown rounded-r-lg border border-regal-brown hover:bg-regal-brown focus:ring-4 focus:outline-none focus:ring-amber-600 dark:bg-regal-brown dark:hover:bg-regal-brown dark:focus:ring-regal-brown">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</form>