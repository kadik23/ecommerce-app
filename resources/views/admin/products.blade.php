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
                    {{count($products)}}/{{count($products)}} </h5>
            </div>
            <x-Select option="Best selling" name="Price" />
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
        <x-Pagination />
    </div>
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
            // document.getElementById('product').value=name     
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