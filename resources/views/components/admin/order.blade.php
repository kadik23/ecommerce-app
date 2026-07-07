<div class="grid grid-cols-7 min-w-[900px] text-xs lg:text-base text-center items-center py-4">
    <span>#{{$id}}</span>
    <div class="flex items-center flex-col justify-center">
        <img src="{{$productImg}}" alt="product" class="w-12 h-12 rounded object-cover mb-1 mx-auto">
        <span class="truncate max-w-[120px]">{{$productName}}</span>
    </div>
    <div class="flex flex-col items-center justify-center">
        <img src="{{$catImg}}" alt="Cat" class="w-8 h-8 rounded object-cover mb-1 mx-auto">
        <span>{{$catName}}</span>
    </div>
    <span>{{$paymentMethod}}</span>
    <div class="flex justify-center">
        <span id="order-status-{{$id}}" class="text-xs lg:text-sm px-3 py-1.5 capitalize border-none text-white text-center rounded-full font-medium inline-block
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
            {{ t('admin.cards.' . $state) }}
        </span>
    </div>
    <div class="flex items-center justify-center gap-1">
        @if($rate > 0)
            <span>{{$rate}} / 5</span>
            <span class="material-symbols-outlined text-amber-500 text-base" style="font-variation-settings: 'FILL' 1;">star</span>
        @else
        ---
        @endif
    </div>
    <div class="flex justify-center items-center">
        <div class="dropdown">
            <div tabindex="0" role="button" class="material-symbols-outlined cursor-pointer text-regal-brown">more_vert</div>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-48 p-2 shadow">
                <li>
                    <div class="flex items-center gap-2 text-regal-brown cursor-pointer confirm-order" data-id="{{$id}}">
                        <span class="material-symbols-outlined">
                            sync_saved_locally
                        </span>
                        <span class="font-semibold">{{ t('admin.orders.confirm') }}</span>
                    </div>
                </li>
                <li>
                    <div class="flex items-center gap-2 text-regal-brown cursor-pointer cancel-order" data-id="{{$id}}">
                        <span class="material-symbols-outlined">
                            delete_forever
                        </span>
                        <span class="font-semibold">{{ t('admin.orders.cancel') }}</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
