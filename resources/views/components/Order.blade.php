<div class="flex items-center justify-around">
    <span>#{{$id}}</span>
    <img src="{{$productImg}}" alt="product">
    <div class="flex items-center">
        <img src="{{$catImg}}" alt="Cat">
        <span>{{$catName}}</span>
    </div>
    <span>{{$payment}}</span>
    <span class=" px-6 py-2 ml-16  border-none text-white text-center rounded-l-full rounded-r-full " style="background-color: {{ $color}}">
        {{$state}}
    </span>
    <div>{{$rate}}</div>
    <div >
        <span class="material-symbols-outlined mr-5 cursor-pointer text-regal-brown">
            edit_note
        </span>
        <span class="material-symbols-outlined cursor-pointer text-regal-brown">
            more_vert
        </span>
    </div>
</div>