<div class="flex items-center justify-around">
    <span class="mx-8 lg:m-0">#{{$id}}</span>
    <div class="flex items-center flex-col">
        <img src="{{$productImg}}" alt="product" class="mx-8 lg:m-0">
        <span>{{$productName}}</span>
    </div>
    <div class="flex-row justify-center lg:flex-row lg:items-center mx-8 lg:m-0">
        <img src="{{$catImg}}" alt="Cat">
        <span>{{$catName}}</span>
    </div>
    <span class="mx-8 lg:m-0">{{$paymentMethod}}</span>
    <span id="order-status-{{$id}}" class="text-xs lg:text-lg px-3 lg:px-6 py-2 ml-16 capitalize border-none text-white text-center rounded-l-full rounded-r-full 
        @if($state === 'pending')
            bg-gray-500
        @elseif($state === 'confirm' || $state === 'confirmed')
            bg-orange-500
        @elseif($state === 'complete' || $state === 'completed')
            bg-green-500
        @elseif($state === 'cancel' || $state === 'canceled')
            bg-red-500
        @endif"
    >
        {{$state}}
    </span>
    <div class="mx-8 lg:m-0">{{$rate}}</div>
    <div class="mx-8 lg:m-0 flex items-center">
        <div class="dropdown">
            <div tabindex="0" role="button" class="material-symbols-outlined cursor-pointer text-regal-brown">more_vert</div>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                <li>
                    <div class="flex items-center gap-2 text-regal-brown cursor-pointer confirm-order" data-id="{{$id}}">
                        <span class="material-symbols-outlined">
                            sync_saved_locally
                        </span>
                        <span class="font-semibold">Confirm</span>
                    </div>
                </li>
                <li>
                    <div class="flex items-center gap-2 text-regal-brown cursor-pointer cancel-order" data-id="{{$id}}">
                        <span class="material-symbols-outlined">
                            delete_forever
                        </span>
                        <span class="font-semibold">Cancel</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
