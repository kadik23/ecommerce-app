<div class="flex items-center justify-around">
    <span class="mx-8 lg:m-0">#{{$id}}</span>
    <img src="{{$productImg}}" alt="product" class="mx-8 lg:m-0">
    <div class="flex-row justify-center lg:flex-row lg:items-center mx-8 lg:m-0">
        <img src="{{$catImg}}" alt="Cat">
        <span>{{$catName}}</span>
    </div>
    <span class="mx-8 lg:m-0">{{$payment}}</span>
    <span class="text-xs lg:text-lg px-3 lg:px-6 py-2 ml-16  border-none text-white text-center rounded-l-full rounded-r-full " style="background-color: {{ $color}}">
        {{$state}}
    </span>
    <div class="mx-8 lg:m-0">{{$rate}}</div>
    <div class="mx-8 lg:m-0 flex items-center">
        <span class="material-symbols-outlined mr-5 cursor-pointer text-regal-brown">
            edit_note
        </span>
        <span class="material-symbols-outlined cursor-pointer text-regal-brown">
            more_vert
        </span>
    </div>
</div>