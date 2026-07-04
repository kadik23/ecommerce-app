@extends('layouts.dashboard')

@section('content1')
<x-admin.titleCard :title="$customersTitle" />
<div class="flex flex-wrap items-stretch justify-between mt-5 ">

    <x-Cards :iconCard="$iconCard[0]" :nbr="$nbr[0]" :orderStat="$cardName[0]"  color="green"/>
    <x-Cards :iconCard="$iconCard[1]" :nbr="$nbr[1]" :orderStat="$cardName[1]"  color="blue"/>
    <x-Cards :iconCard="$iconCard[2]" :nbr="$nbr[2]" :orderStat="$cardName[2]"  color="gray"/>
    <x-Cards :iconCard="$iconCard[3]" :nbr="$nbr[3]" :orderStat="$cardName[3]"  color="yellow"/>
    <div class="m-3 px-16 flex flex-col justify-center bg-white border border-gray-200 rounded-lg shadow sm:py-3 dark:bg-gray-800 dark:border-gray-700">
        <h1 class="text-xl text-start font-bold">Conversion Rate</h1>
        <div class="flex justify-between gap-6">
            <span class="text-regal-brown text-md p-2 font-semibold">YEAR</span>
            <span class="text-regal-brown text-md p-2 font-semibold">CUSTOMERS</span>
            <span class="text-regal-brown text-md p-2 font-semibold">REVENUE</span>
        </div>
        @foreach($conversionRateData as $data)
            <div class="flex justify-between gap-6 py-1">
                <span class="text-md font-bold p-2">{{ $data['year'] }}</span>
                <span class="text-md font-bold p-2">{{ $data['customers'] }}</span>
                <span class="text-md font-bold p-2">${{ number_format($data['revenue'], 2) }}</span>
            </div>
            @if(!$loop->last)
                <hr>
            @endif
        @endforeach
    </div>
</div>

<div class="m-3 px-2 bg-white border border-gray-200 rounded-lg shadow p-8 dark:bg-gray-800 dark:border-gray-700">
    
    <div class="flow-root overflow-x-auto w-full">
        <div class="grid grid-cols-5 min-w-[600px] text-xs lg:text-base font-semibold text-center items-center py-4 border-b border-gray-200 dark:border-gray-700">
            <span class="text-regal-brown">PROFILE IMAGE</span>
            <span class="text-regal-brown">FULLNAME</span>
            <span class="text-regal-brown">EMAIL</span>
            <span class="text-regal-brown">REVENUE</span>
            <span class="text-regal-brown">COUNTRY</span>
        </div> 
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($customers as $customer)
                <x-admin.CustumersCard 
                    :fullname="$customer->fullName" 
                    :email="$customer->email" 
                    :revenue="$customer->revenue" 
                    :country="$customer->country" 
                    :profileImage="$customer->profileImage" 
                />
            @endforeach
        </div>
    </div>
</div>

<div class="mt-4">
    <x-Pagination :paginator="$customers" />
</div>

@endsection