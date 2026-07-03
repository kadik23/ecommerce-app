@extends('layouts.dashboard')

@section('content1')
    <div class="bg-white  mt-16 rounded-lg  mx-20 shadow dark:bg-gray-900 ">
        <div style="" class="w-full max-w-screen-xl mx-auto flex justify-center items-end  md:py-2">
            <a href="{{route('product.create')}}"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create
                new product</a>
            <!-- Modal toggle -->
            <!-- Open the modal using ID.showModal() method -->
            {{-- <button class="btn">open modal</button> --}}
            {{-- <dialog id="my_modal_2" class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Hello!</h3>
                    <p class="py-4">Press ESC key or click outside to close</p>
                </div>
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog> --}}

            <button onclick="my_modal_1.showModal()"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mt-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Create
                new category</button>
            <x-admin.modalCategorie />
            <div class="mt-3">
                <x-SearchBar :categories="$categories" />
            </div>
        </div>
    </div>

    <x-alert message="Successfully deleted" />

    <div class="flex justify-between items-center">
        <div class="inline-block mt-5 ml-16 ">
            <div
                class="m-3 px-2 bg-white border border-gray-200 rounded-lg shadow sm:p-4 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex  text-center justify-around items-center rounded-md  px-4">
                    @php
                        if (isset($categoryS)) {
                            if ($categoryS !== "All categories") {
                                $cat = "All categories";
                                foreach ($Categories as $category) {
                                    if ($category->name == $categoryS) {
                                        $cat = $category->icon;
                                        $src = asset("assets/images/categories/" . $cat);
                                        break;
                                    }
                                }
                            } else {
                                $src = asset("assets/images/icons8-categorize-48.png");
                            }
                        }
                    @endphp
                    <img src="{{isset($categoryS) ? $src : asset('assets\images\icons8-categorize-48.png')}}">
                    <h5 class="inline-block text-xl font-semibold cursor-default text-gray-900 dark:text-white">
                        {{ $categoryS ?? 'All Categories'}} </h5>
                </div>
            </div>
        </div>
        <div class=" flex flex-col mr-16 items-end">
            <div class="inline-block mt-5 ">
                <h5 class="inline-block text-md  cursor-default  text-gray-600 dark:text-white">Views products
                    {{$products->count()}}/{{$products->total()}} </h5>
            </div>
            <x-Select option="Default Sorting" name="Price" />
        </div>
    </div>

    <div id="productList" class=" flex ml-9 flex-wrap dark:bg-gray-900">
        @if($products !== [])
            @foreach ($products as $product)
                <x-productCard :name="$product->name" :profile="$product->getPhotoAttribute($product->profileImage)"
                    :id="$product->id" :category="$product->category" :sold="$product->sold" :quantity="$product->quantity"
                    :price="$product->price" :rating="$product->rating" />
            @endforeach
        @else
            <div>
                <h1><b> Viewing results for All Categories</b></h1>
                <p> No results for {{$product}} in <b> {{$categoryS}} </b>categories </p>
            </div>
        @endif
        <x-Pagination :paginator="$products" />
    </div>

    @if( (Auth::check()) && (Auth::user()->hasRole('admin')) )
    <dialog id="authentication_modal" class="modal">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <form method="dialog" class="modal-backdrop">
                    <button class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </form>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit your product</h3>
                    <form id="editProductForm" class="space-y-6" method="POST" action="" enctype="multipart/form-data">
                        @csrf 
                        @method("PUT")
                        <input id="idModal" name="idModal" type="hidden">  
                        <div>
                            <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product name</label>
                            <input type="text" name="product" id="product" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-700 focus:border-regal-brown block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Product name" required>
                        </div>
                        @error('product')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                        @enderror
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload image</label>
                            <input name="file_input" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-regal-brown dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                        </div>
                        @error('file_input')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                        @enderror
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Price</label>
                            <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-700 focus:border-regal-brown block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Price" required>
                        </div>
                        @error('price')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                        @enderror
                        
                        <button type="submit" class="w-full text-white bg-regal-brown hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-regal-brown dark:hover:bg-regal-brown dark:focus:ring-amber-700">Edit product</button>
                    </form>
                </div>
            </div>
        </div>
    </dialog> 
    @endif
@endsection
@section('script')
    <script>
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    // When the card enters the viewport, remove the "product-card" class and add the "visible-card" class
                    entry.target.classList.remove("product-card");
                    entry.target.classList.add("visible-card");
                    observer.unobserve(entry.target); // Stop observing once animation is applied
                }
            });
        });

        // Select all elements with the "product-card" class and observe them
        const hiddenCards = document.querySelectorAll(".product-card");
        hiddenCards.forEach((card) => {
            observer.observe(card);
        });


        // Modal   
        function targett(ev) {
            // get data from product target
            let name = ev.getAttribute('data-name');
            let image = ev.getAttribute('data-image');
            let price = ev.getAttribute('data-price');
            let id = ev.getAttribute('data-id');
            //implement modal with data target
            document.getElementById('product').value = name
            document.getElementById('price').value = price
            document.getElementById('idModal').value = id    
            // Set dynamic form action url
            document.getElementById('editProductForm').action = "/dashboard/product/" + id;
        }

        // delete product..
        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
            var id = $(this).attr('product_id');
            $.ajax({
                type: 'post',
                url: "{{ route('product.destroy', '') }}/" + id,
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': id,
                    '_method': 'DELETE', // Add this for Laravel to recognize it as a DELETE request
                },
                success: function (data) {
                    if (data.status == true) {
                        setTimeout(() => {
                            $('#success_msg').hide();
                        }, 2000);
                        $('#success_msg').show();
                    }
                    $('.product' + data.id).remove();

                }, error: function (reject) {
                }
            });
        });

        // submetting when select
        $(document).ready(function () {
            $('#filter').on('change', function () {
                $('#filterForm').submit();
            });
        });
    </script>
@endsection