@extends('layouts.app')

@section('content')
<x-users.carousel />  <!-- Slider.. -->
<!-- Begin of Product card -->
<div class="container">
  <h1 class="text-lg lg:text-3xl text-center font-bold my-10">Top Products</h1>
  <div id="productList" class=" flex ml-9 flex-wrap dark:bg-gray-900">
    @if($products!==[])
            @foreach ($products as $product)
            <x-productCard  :name="$product->name" :profile="$product->getPhotoAttribute($product->profileImage)" :id="$product->id" :category="$product->category" :sold="$product->sold" :quantity="$product->quantity" :price="$product->price" :rating="$product->rating" />
            @endforeach
    @endif
  </div>
</div>
<!-- End of Product card  -->
<!-- Begin of Intro -->
<section id="intro" class="h-96 intro flex items-center">
  <div>
    <div class="w-2/3 lg:w-1/3 ml-10 rounded-md bg-white text-center flex flex-col items-center justify-start ">
      <img src="{{asset('assets/images/logo.png')}}" class="w-40 h-36 " alt="">
      <p class="font-md text-xs lg:text-lg">Welcome to Stanissk Store, where shopping meets convenience and quality. With a wide range of products to choose from, we're your one-stop destination for all your shopping needs.</p>
      <button class="bg-regal-brown my-5 text-xs lg:text-md lg:py-2 px-3 text-white rounded-3xl py-1">SHOP NOW</button>
    </div>
  </div>
</section>
<!-- End of Intro -->
<div class="container">
  <h1 class="text-lg lg:text-3xl text-center font-bold my-10">Latest</h1>
  <div id="productList" class="flex ml-9 flex-wrap dark:bg-gray-900">
    @if($products!==[])
            @foreach ($products as $product)
            <x-productC ard  :name="$product->name" :profile="$product->getPhotoAttribute($product->profileImage)" :id="$product->id" :category="$product->category" :sold="$product->sold" :quantity="$product->quantity" :price="$product->price" :rating="$product->rating" />
            @endforeach
    @endif
  </div>
</div>
<!-- Begin of Category Card -->
<h1 class="text-lg lg:text-3xl text-center font-bold my-10">SHOP BY BRAND</h1>
<div class="flex flex-wrap justify-around m-10">
  <x-users.categoryCard category="Phones" image="hal-gatewood-WcYeiHMexR0-unsplash.jpg" />
  <x-users.categoryCard category="Accesories" image="marissa-grootes-D4jRahaUaIc-unsplash.jpg" />
  <x-users.categoryCard category="Electronics" image="umberto-jXd2FSvcRr8-unsplash.jpg" />
</div>
{{-- End of Category Card --}}
<div class="container">
  <h1 id="electronics" class="text-lg lg:text-3xl text-center font-bold my-10">BEST OFFERS HIGH ELECTRONICS </h1>
  <div id="productList" class=" flex ml-9 flex-wrap dark:bg-gray-900">
    @if($products!==[])
            @foreach ($products as $product)
              @if($product->category=="Electronics")
              <x-productCard  :name="$product->name" :profile="$product->getPhotoAttribute($product->profileImage)" :id="$product->id" :category="$product->category" :sold="$product->sold" :quantity="$product->quantity" :price="$product->price" :rating="$product->rating" />
              @endif
            @endforeach
    @endif
  </div>
</div>
<div class="container">
  <h1 id="phones" class="text-lg lg:text-3xl text-center font-bold my-10">BEST OFFERS HIGH PHONES </h1>
  <div id="productList" class=" flex ml-9 flex-wrap dark:bg-gray-900">
    @if($products!==[])
            @foreach ($products as $product)
              @if($product->category=="Phones")
              <x-productCard  :name="$product->name" :profile="$product->getPhotoAttribute($product->profileImage)" :id="$product->id" :category="$product->category" :sold="$product->sold" :quantity="$product->quantity" :price="$product->price" :rating="$product->rating" />
              @endif
            @endforeach
    @endif
  </div>
</div>
<div class="container">
  <h1 id="accessories" class="text-lg lg:text-3xl text-center font-bold my-10">BEST OFFERS HIGH ACCESSORIES </h1>
  <div id="productList" class=" flex ml-9 flex-wrap dark:bg-gray-900">
    @if($products!==[])
            @foreach ($products as $product)
              @if($product->category=="Accessories")
              <x-productCard  :name="$product->name" :profile="$product->getPhotoAttribute($product->profileImage)" :id="$product->id" :category="$product->category" :sold="$product->sold" :quantity="$product->quantity" :price="$product->price" :rating="$product->rating" />
              @endif
            @endforeach
    @endif
  </div>
</div>
{{-- Begin our partners --}}
<div class="p-16 w-full flex flex-col justify-around bg-slate-100 opacity-70">
  <h1 class="text-lg lg:text-2xl font-bold opacity-90  text-center m-5">OUR PARTNERS</h1>
  <div class="flex flex-col lg:flex-row items-center justify-around">
    <div class="w-36 p-2 flex items-center bg-white h-20">
      <img src="{{asset('assets/images/partners/images.png')}}" class="w-full" alt="">
    </div>
    <div class="w-36 p-2 flex items-center bg-white h-20">
      <img src="{{asset('assets/images/partners/images (1).png')}}" class="w-full" alt="">

    </div>  
    <div class="w-36 p-2 flex items-center bg-white h-20">
      <img src="{{asset('assets/images/partners/images (2).png')}}" class="w-full" alt="">

    </div>  
    <div class="w-36 p-2 flex items-center bg-white h-20">
      <img src="{{asset('assets/images/partners/download.png')}}" class="w-full" alt="">
    </div>
  </div>
  
</div>
{{-- End our partners --}}
@endsection
@section('script')
<script>
  // hover category cards
  document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".cardCat");

    cards.forEach(card => {
        const square1 = card.querySelector(".square1");
        const square2 = card.querySelector(".square2");

        card.addEventListener("mouseover", function () {
            // Get the dimensions of the current card
            const cardRect = card.getBoundingClientRect();

            // Apply the dimensions to square1
            square1.style.width = cardRect.width + "px";
            square1.style.height = cardRect.height + "px";

            // Apply the dimensions to square2
            square2.style.width = cardRect.width + "px";
            square2.style.height = cardRect.height + "px";
        });

        card.addEventListener("mouseout", function () {
            // Reset the dimensions of square1 and square2 to 0
            square1.style.width = "0";
            square1.style.height = "0";
            square2.style.width = "0";
            square2.style.height = "0";
        });
    });
});

// Select all elements with the class "favorite"
var favoriteElements = document.querySelectorAll('.favorite');
// Add a click event listener to each "favorite" element
favoriteElements.forEach(function(element) {
  element.addEventListener('click', function (event) {
    var clickedCard = event.target;
    // Add fill class to fill favorite icon or remove it
    clickedCard.classList.toggle('fill');
  });
});

// Scroll into view you want 
var categoryElements = document.querySelectorAll('.category');
categoryElements.forEach(function(el){
  el.addEventListener('click',function scrollToView(ev){
    const targetElement= ev.target
    let id = targetElement.getAttribute("id")
    let scrollToSection2Button;
    // Get a reference to the button and the section you want to scroll to
    if(id=='phone_btn'){
      const scrollToSection2Button = document.getElementById(id);
      const section = document.getElementById('phones');
      section.scrollIntoView({ behavior: 'smooth' });
    }else if(id=='electronic_btn'){
        const scrollToSection2Button = document.getElementById(id);
        const section = document.getElementById('electronics');
        section.scrollIntoView({ behavior: 'smooth' });
    }else if(id=='accessory_btn'){
        const scrollToSection2Button = document.getElementById(id);
        const section = document.getElementById('accessories');
        section.scrollIntoView({ behavior: 'smooth' });
    }
  })
})

// add to cart with ajax 
    $(document).on('click', '.addToCart', function (e) {
                e.preventDefault();
                  var id =  $(this).attr('product_id');   
                $.ajax({
                    type: 'post',
                    url:"{{ route('cart.store') }}",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'id' :id,
                    },
                    success: function (data) {
                    }, error: function (reject) {
                    }
                });
    });
</script>
@endsection
