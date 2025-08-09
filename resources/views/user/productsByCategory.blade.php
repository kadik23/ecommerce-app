@extends('layouts.app')

@section('content')
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
<div id="productList" class=" flex ml-9 flex-wrap dark:bg-gray-900">
    @if($products!==[])
            @foreach ($products as $product)
            <x-productCard  :name="$product->name" :profile="$product->getPhotoAttribute($product->profileImage)" :id="$product->id" :category="$product->category" :sold="$product->sold" :quantity="$product->quantity" :price="$product->price" :rating="$product->rating" />
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