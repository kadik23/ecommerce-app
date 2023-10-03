@extends('layouts.dashboard')

@section('content1')
<div class="bg-white  mt-16 rounded-lg  mx-20 shadow dark:bg-gray-900 ">
    <div style="" class="w-full max-w-screen-xl mx-auto flex justify-center items-end  md:py-2">
        <a href="{{route('product.create')}}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create new product</a>
        <!-- Modal toggle -->
        <button  data-modal-target="category" data-modal-toggle="category" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Create new category</button>
        <x-admin.modalCategorie  />
        
      
        <form class="mt-2" method="GET" action="{{route('product.show', $categoryS??'categories')}}">
            @csrf   
            <div class="flex ">
                <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
               
                <select name="category"  id="category" class="flex-shrink-0 active:border-none focus:border-none ml-3 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600">
                    <option value="All categories" selected>All categories</option>
                    @foreach($Categories AS $category)
                    <option value="{{$category->name}}" class="opt p-16">
                        {{$category->name}}
                    </option>
                    @endforeach
                </select>
                
            
                <div class="relative w-96">
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
       

    </div>
</div>
<x-alert message="Successfully deleted"/>

   
<div class="flex justify-between items-center">         
    <div class="inline-block mt-5 ml-16 ">
        <div class="m-3 px-2 bg-white border border-gray-200 rounded-lg shadow sm:p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex  text-center justify-around items-center rounded-md  px-4">
                @php
                    if(isset($categoryS)){
                        if($categoryS!=="All categories"){
                            $cat="All categories";
                            foreach ($Categories as $category) {
                                if($category->name==$categoryS)
                                {   $cat=$category->icon;
                                    $src=asset("assets/images/categories/".$cat);
                                    break;
                                }
                            } 
                        }
                        else{
                              $src=asset("assets/images/icons8-categorize-48.png");
                        }
                        
                    }
                @endphp
                <img src="{{isset($categoryS) ? $src : asset('assets\images\icons8-categorize-48.png')}}">                   
                <h5 class="inline-block text-xl font-semibold cursor-default text-gray-900 dark:text-white">{{ $categoryS??'All Categories'}} </h5>
            </div>  
        </div>
    </div>
    <div class=" flex flex-col mr-16 items-end">
        <div class="inline-block mt-5 ">
            <h5 class="inline-block text-md  cursor-default  text-gray-600 dark:text-white">Views products {{count($productsController)}}/{{count($Products)}} </h5>
        </div> 

        <x-Select option="Best selling" name="Price" />
    

    </div>
 
</div> 

<div id="productList" class=" flex ml-9 flex-wrap dark:bg-gray-900">
    @if($productsController!==[])
            @foreach ($productsController as $product)
            <x-productCard  :name="$product->name" :profile="$product->getPhotoAttribute($product->profileImage)" :id="$product->id" :category="$product->category" :sold="$product->sold" :quantity="$product->quantity" :price="$product->price" :rating="$product->rating" />
            @endforeach
            {{-- <h1> Viewing results for All Categories {{$productsController}}</h1> --}}
                {{-- {{$select }} 
                {{$filter}} --}}
    @else 
        <div>
            <h1><b> Viewing results for All Categories</b></h1> 
            <p> No results for {{$product}} in <b> {{$categoryS}} </b>categories </p>
        </div>
        
   @endif
<x-Pagination />
</div>
@endsection
@section('script')
<script>

    document.addEventListener("DOMContentLoaded", function() {
        const productCards = document.querySelectorAll(".product-card");
    
        function checkVisibility() {
            productCards.forEach((card) => {
                const rect = card.getBoundingClientRect();
                const windowHeight = window.innerHeight || document.documentElement.clientHeight;
    
                // Calculate the top and bottom boundaries of the card
                const cardTop = rect.top;
                const cardBottom = rect.bottom;
    
                // Check if any part of the card is visible in the viewport
                if (cardBottom >= 0 && cardTop <= windowHeight) {
                    // Calculate the visible height of the card
                    const visibleHeight = Math.min(cardBottom, windowHeight) - Math.max(cardTop, 0);
    
                    // Calculate opacity based on visible height
                    const opacity = visibleHeight / card.clientHeight;
    
                    card.style.opacity = opacity;
                    card.style.transform = `translateY(0)`;
                } else {
                    // Reset the animation state if the card is outside the viewport
                    card.style.opacity = 0;
                    card.style.transform = "translateY(20px)";
                }
            });
        }
    
        // Listen for scroll events to trigger the animation
        window.addEventListener("scroll", checkVisibility);
    
        // Initial check when the page loads
        checkVisibility();
    });
    
    
    // Modal 
    
    function targett(ev){
        // get data from product target
        let name=ev.getAttribute('data-name');
        let image=ev.getAttribute('data-image');
        let price=ev.getAttribute('data-price');
        let id=ev.getAttribute('data-id');
    
        //implement modal with data target
        document.getElementById('product').value=name
        document.getElementById('price').value=price
        document.getElementById('idModal').value=id
        // document.getElementById('product').value=name
        
    }
    
    // delete product..
    $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
    
                  var id =  $(this).attr('product_id');
    
                $.ajax({
                    type: 'post',
                     url:"{{ route('product.destroy', '') }}/" + id,
                    data: {
                        '_token': "{{csrf_token()}}",
                        'id' :id,
                        '_method': 'DELETE', // Add this for Laravel to recognize it as a DELETE request
                    },
                    success: function (data) {
                        if(data.status == true){
                            setTimeout(() => {
                                $('#success_msg').hide();
                            }, 2000);
                            $('#success_msg').show();
                        }
                        $('.product'+data.id).remove();
                        
                    }, error: function (reject) {
    
                    }
                });
            });
    
    // submetting when select
    $(document).ready(function() {
    $('#filter').on('change', function() {
        $('#filterForm').submit();
    });
});
    </script>
@endsection
