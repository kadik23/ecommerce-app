@extends('layouts.dashboard')

@section('content1')
<x-admin.titleCard title="Product Creating" />


<form action="{{route('product.store')}}" method="POST" class="bg-white dark:bg-gray-800 m-3 p-5 rounded-lg flex flex-row justify-around text-gray-900 dark:text-white border border-gray-100 dark:border-gray-700 shadow" enctype="multipart/form-data">
    @csrf
    <div class="w-1/3">
        <div class="mb-6">
            <label for="name" class="block  mb-2 text-md font-medium text-gray-900 dark:text-white">Product name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-regal-brown focus:border-regal-brown block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-regal-brown dark:focus:border-regal-brown" placeholder="Product name" required>
            @error('name')
            {{-- print to users error when it exist  --}}
             {{$message}}  
            @enderror
        </div>
        <div class="mb-6">
            <label for="price" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Price</label>
            <input type="number" id="price" name="price" value="{{ old('price') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-regal-brown focus:border-regal-brown block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-regal-brown dark:focus:border-regal-brown" required>
            @error('price')
            {{$message}}  
            @enderror
        </div>
        <div class="mb-6">
            <label for="category" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Category</label>
            {{-- <input type="text" id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-regal-brown focus:border-regal-brown block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-regal-brown dark:focus:border-regal-brown" placeholder="Category" required> --}}
            <select name="category" id="category" class="bg-gray-50  border-gray-300 text-gray-900 text-md rounded-lg focus:ring-regal-brown focus:border-regal-brown block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-regal-brown dark:focus:border-regal-brown">
                @foreach($Categories AS $category)
                <option value="{{$category->name}}" {{ old('category') == $category->name ? 'selected' : '' }}>
                    {{$category->name}}
                </option>
                @endforeach
            </select>
            @error('category')
            {{$message}}  
            @enderror
        </div>
        <div class="mb-6">
            <label for="qnt" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Quantity</label>
            <input type="number" id="qnt" name="qnt" value="{{ old('qnt') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-regal-brown focus:border-regal-brown block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-regal-brown dark:focus:border-regal-brown" required>
        </div>
        <div class="mb-6">
            <label for="sold" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Sold</label>
            <input type="number" name="sold" id="sold" value="{{ old('sold') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-regal-brown focus:border-regal-brown block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-regal-brown dark:focus:border-regal-brown" >
            @error('sold')
            {{$message}}  
            @enderror
        </div>
    
        <button type="submit" class="text-white bg-regal-brown hover:bg-amber-700 focus:ring-4 focus:outline-none focus:ring-amber-600 font-medium rounded-lg text-md w-full sm:w-auto px-5 py-2.5 text-center dark:bg-regal-brown dark:hover:bg-amber-700 dark:focus:ring-amber-600">Create a product</button>
    
    </div>
    <div class="w-1/3"> 
        <div class="mb-6">
            <label for="description" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Description</label>
            <textarea  id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-regal-brown focus:border-regal-brown block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-regal-brown dark:focus:border-regal-brown" rows="3" cols="20">{{ old('description') }}</textarea>
            @error('description')
            {{$message}}  
            @enderror
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700 dark:text-gray-200 font-bold mb-2">Choose a product image:</label>
            <input type="file" name="image" id="image" class="appearance-none border dark:border-gray-600 dark:bg-gray-700 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline">
            @error('image')
            <div class="p-3 mb-4 text-sm text-red-800 rounded-lg dark:text-red-400" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</form>
@endsection