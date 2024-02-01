@extends('layouts.accounts')

@section('content')


<div class="font-bold flex mt-10 text-regal-brown px-10 text-3xl ">Cart :</div>
<nav class="flex mx-10  mt-10 mb-5" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-regal-brown dark:text-gray-400 dark:hover:text-white">
            <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
            </svg>
            Home
            </a>
        </li>
        <li>
            <div class="flex items-center">
            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-regal-brown md:ml-2 dark:text-gray-400 dark:hover:text-white">Projects</a>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Cart</span>
            </div>
        </li>
    </ol>
</nav>  
<div class="flex flex-wrap">
    <div class="flex flex-col">
    @foreach($Carts as $Cart)
        <x-users.cart 
            :id="$Cart->id"
            :productName="$Cart->name" 
            sold="23" price_sold="5900" 
            :price="$Cart->price" 
            :description="$Cart->description" 
            size="13" 
            :img="$Cart->getPhotoAttribute($Cart->profileImage)"
        />
    @endforeach
    @php 
    $cartsArray = $Carts->toArray();
    $totalPrice = array_sum(array_column($cartsArray, 'price'));
    @endphp
  </div>
    <div class=" w-1/3 flex flex-col justify-between h-32 px-5 py-2.5  rounded-sm " style="background-color: rgba(128, 128, 128, 0.098)"">
        <p>CART SUMMARY <span class="font-bold" class="totalPrice">{{$totalPrice}}</span>$</p>
        <div class="pb-2.5">
            <p class="opacity-70 ">Fast delivery - 24 hours to major cities</p>
            <form action="{{ route('order.store') }}" method="post">
                @csrf
                @forEach($Carts as $Cart)
                <input type="hidden" id="hidden{{ $Cart->id }}" name="hidden{{$Cart->id}}" value="1">
                @endforeach
                <input type="hidden" id="1" name="productId" value="1">
                <button   class="text-white bg-regal-brown hover:bg-amber-700 focus:ring-4 focus:ring-amber-800 font-medium rounded-lg text-sm px-16 w-full py-2 mr-2 mb-2  focus:outline-none">
                    Order (<span class="totalPrice">{{ $totalPrice}}  </span>$)
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    let totalPrice = document.querySelector(".totalPrice")
    function increment_quantity(id) {
        let quantity = document.querySelector(`.quantity${id}`);
        let price = document.getElementById(`price${id}`)
        let finalQuantity = document.querySelector(`#hidden${id}`)
        let new_Qnt = parseInt(quantity.innerHTML) + 1;
        totalPrice.innerHTML =  parseInt(totalPrice.innerHTML)+parseInt(price.innerHTML);
        quantity.innerHTML = new_Qnt;
        finalQuantity.setAttribute("value", new_Qnt);
        console.log(totalPrice)
    }

    function decrement_quantity(id) {
        let quantity = document.querySelector(`.quantity${id}`);
        let price = document.getElementById(`price${id}`)
        let finalQuantity = document.querySelector(`#hidden${id}`)
        let new_Qnt = parseInt(quantity.innerHTML) - 1;
        if (new_Qnt >= 0) {
            totalPrice.innerHTML =  parseInt(totalPrice.innerHTML)-parseInt(price.innerHTML);
            quantity.innerHTML = new_Qnt;
            finalQuantity.setAttribute("value", new_Qnt);
        }
        console.log(totalPrice)
    }

</script>
@endsection