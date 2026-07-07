{{-- Product card --}}
@if(Auth::check())
<div class="product{{$id}} max-w-sm product-card overflow-hidden hover:shadow-xl bg-white border border-gray-200 my-5 mx-8 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height:{{Auth::user()->hasRole('admin') ? '450': '400'}}px; width:300px;">
@else
<div class="product{{$id}} max-w-sm product-card overflow-hidden hover:shadow-xl bg-white border border-gray-200 my-5 mx-10 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" style="height:400px; width:300px;">
@endif
    <div class="overflow-hidden h-3/5">
        <img class="product overflow-hidden rounded-t-lg w-full h-full object-cover" src="{{$profile}}" alt="product image" />
    </div>
    <input type="hidden" name="id" id="id" value="{{$id}}">
    <input type="hidden" name="category" id="categoy" value="{{$category}}">
    <div class="px-3 pb-3">
        <div>
            <h5 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white">{{$name}}</h5>
        </div>
        <div class="flex items-center mt-2.5 mb-5">
        
            @for($i=1;$i<=$rating;$i++)
            <svg class="w-4 h-4 text-yellow-300 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
            </svg>
            @endfor
            @for($i=$rating;$i<5;$i++)
            <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
            </svg>
            @endfor
            <span class="bg-amber-100 text-regal-brown text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-amber-200 dark:text-regal-brown ml-3">
                @if($rating==null) 
                0.00 
                @else {{$rating}}
                @endif
            </span>
        </div>
        <div class="flex flex-col">
            @Auth
            @if(Auth::user()->hasRole('admin')) 
            <span class="text-green-500 font-bold">{{ t('admin.products.available') }} : {{$quantity}}</span>
            <span class="text-blue-600 font-bold">{{ t('admin.products.sold_percent') }} : {{$sold}}%</span>
            @endif 
            @endauth
        </div>
        <div class="flex items-center justify-between">
            <span class="text-xl font-bold text-gray-900 dark:text-white">${{$price}}</span>
            <div class="flex items-center ">
            @if( !(Auth::check()) || (Auth::user()->hasRole('user')) )
                <div class="p-1  mx-3 cursor-pointer hover:bg-slate-100 flex justify-center items-center border-2 border-slate-700  rounded-full">
                    <span class="material-symbols-outlined favorite">
                        favorite
                    </span>
                </div>
                <a href="" product_id="{{$id}}" class="text-white addToCart bg-regal-brown hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-amber-500 font-medium rounded-lg text-sm px-3 py-2.5 text-center dark:bg-regal-brown dark:hover:bg-regal-brown dark:focus:ring-amber-700">{{ t('admin.products.add_to_cart') }}</a>
            @elseif(Auth::user()->hasRole('admin')) 
                <div class="inline-block bg-transparent" onclick="authentication_modal.showModal()">  
                    <a  data-name="{{$name}}"
                    data-image="{{$profile}}"
                    data-price="{{$price}}"
                    data-id="{{$id}}"
                    href="#" 
                    onclick="targett(this)"
                    id="{{$id}}"
                    class="text-white mr-3 bg-regal-brown hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-amber-500 font-medium rounded-lg text-sm px-3 py-2.5 text-center dark:bg-regal-brown dark:hover:bg-regal-brown dark:focus:ring-amber-700">{{ t('admin.products.edit') }}</a>
                </div>
                <a href="" product_id="{{$id}}"   class="text-red-700 delete_btn my-auto hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2  dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">{{ t('admin.products.delete') }}</a>
            @endif  
            </div>
        </div>
    </div>
</div>

 
