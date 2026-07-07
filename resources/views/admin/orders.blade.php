@extends('layouts.dashboard')

@section('content1')
<x-admin.titleCard :title="$orderTitle" />
<div class="flex flex-wrap justify-between mt-5 ">
    <?php
    $colors = ['blue', 'red', 'green', 'black'];    
    ?>
    @foreach($iconCard as $index => $icon)
        <x-Cards 
            :iconCard="$icon" 
            :nbr="$nbr[$index]" 
            :orderStat="$orderStat[$index]"  
            :color="$colors[$index]" 
        />
    @endforeach
    <div class="m-3 flex flex-col justify-end items-end">
        <div class="">
            <h5 class="mb-3 text-md text-end cursor-default text-gray-600 dark:text-white">
                {{ t('admin.orders.views_orders') }} {{ $orders->count() }}/{{ $orders->total() }}
            </h5>
        </div> 
        <x-Select action="{{ route('dashboard.orders') }}" option="{{ t('admin.orders.default_sorting') }}" name="Rating" />
    </div>
</div>
<div class="m-3 px-2 bg-white border border-gray-200 rounded-lg overflow-x-auto shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
    <div class="grid grid-cols-7 min-w-[900px] text-xs lg:text-base font-semibold text-center items-center py-4 border-b border-gray-200 dark:border-gray-700">
        <span class="text-regal-brown">{{ t('admin.orders.table.order') }}</span>
        <span class="text-regal-brown">{{ t('admin.orders.table.product') }}</span>
        <span class="text-regal-brown">{{ t('admin.orders.table.category') }}</span>
        <span class="text-regal-brown">{{ t('admin.orders.table.payment_method') }}</span>
        <span class="text-regal-brown">{{ t('admin.orders.table.order_status') }}</span>
        <span class="text-regal-brown">{{ t('admin.orders.table.rate') }}</span>
        <span class="text-regal-brown">{{ t('admin.orders.table.actions') }}</span>
    </div>
    @if(isset($orders))
        @foreach($orders as $order)
            @php
                $catName = $order->product ? $order->product->category : 'Electronics';
                $categoryObj = $categories->firstWhere('name', $catName);
                $catIconName = $categoryObj ? $categoryObj->icon : null;
                $catImg = ($catIconName && file_exists(public_path('assets/images/categories/' . $catIconName))) 
                    ? asset('assets/images/categories/' . $catIconName) 
                    : asset('assets/images/icons8-categorize-48.png');
                
                $prodImgName = ($order->product) ? $order->product->profileImage : null;
                $productImg = ($prodImgName && file_exists(public_path('assets/images/products/' . $prodImgName)))
                    ? $order->product->getPhotoAttribute($prodImgName)
                    : asset('assets/images/logo.png');
                
                $productName = $order->product ? $order->product->name : 'Product';
                $rating = $order->product ? $order->product->rating : 0;
            @endphp
            <x-admin.order 
                :id="$order->id" 
                :paymentMethod="$order->paymentMethod" 
                :catImg="$catImg"
                :catName="$catName"
                :state="$order->state" 
                :rate="$rating" 
                :productImg="$productImg"
                :productName="$productName"
                />
            <hr class="my-5">
        @endforeach
    @endif
</div>
<x-Pagination :paginator="$orders" />
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Use event delegation or direct click listener
        $(document).on('click', '.confirm-order', function(e) {
            e.preventDefault();
            const orderId = $(this).data('id');
            updateOrderStatus(orderId, 'confirm');
        });

        $(document).on('click', '.cancel-order', function(e) {
            e.preventDefault();
            const orderId = $(this).data('id');
            updateOrderStatus(orderId, 'cancel');
        });

        // Auto-submit filter form on select change
        $(document).on('change', '#filter', function() {
            $('#filterForm').submit();
        });
    });

    function updateOrderStatus(orderId, newStatus) {
        $.ajax({
            url: `/dashboard/order/${orderId}/update-status`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    const statusSpan = $(`#order-status-${orderId}`);
                    statusSpan.text(newStatus);
                    
                    // Reset status bg colors
                    statusSpan.removeClass('bg-gray-500 bg-orange-500 bg-green-500 bg-red-500');
                    
                    // Apply new colors
                    if (newStatus === 'confirm' || newStatus === 'confirmed') {
                        statusSpan.addClass('bg-orange-500');
                    } else if (newStatus === 'cancel' || newStatus === 'canceled') {
                        statusSpan.addClass('bg-red-500');
                    } else if (newStatus === 'complete' || newStatus === 'completed') {
                        statusSpan.addClass('bg-green-500');
                    } else {
                        statusSpan.addClass('bg-gray-500');
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error("Failed to update status:", error);
            }
        });
    }
</script>
@endsection
