@extends('layouts.dashboard')

@section('content1')
<x-admin.titleCard :title="$customersTitle" />
<div class="flex justify-between ">

    <x-Cards :iconCard="$iconCard[0]" :nbr="$nbr[0]" :orderStat="$cardName[0]"  color="green"/>
    <x-Cards :iconCard="$iconCard[1]" :nbr="$nbr[1]" :orderStat="$cardName[1]"  color="blue"/>
    <x-Cards :iconCard="$iconCard[2]" :nbr="$nbr[2]" :orderStat="$cardName[2]"  color="gray"/>
    <x-Cards :iconCard="$iconCard[3]" :nbr="$nbr[3]" :orderStat="$cardName[3]"  color="yellow"/>
    <div class="m-3 px-16 inline-block text-center bg-white border border-gray-200 rounded-lg shadow sm:py-3 dark:bg-gray-800 dark:border-gray-700">
        <h1 class="text-xl text-start font-bold">Conversion Rate</h1>
        <div class="flex justify-between">
            <span class="text-regal-brown text-md p-2">YEAR</span>
            <span class="text-regal-brown text-md p-2">CUSTOMERS</span>
            <span class="text-regal-brown text-md p-2">REVENUE</span>
        </div>
        <div class="flex justify-between">
            <span class=" text-md font-bold p-2">2022</span>
            <span class=" text-md font-bold p-2">202</span>
            <span class=" text-md font-bold p-2">$316</span>
        </div>
        <hr>
        <div class="flex justify-between">
            <span class=" text-md font-bold p-2">2023</span>
            <span class=" text-md font-bold p-2">409</span>
            <span class=" text-md font-bold p-2">$24</span>
        </div>
    
    </div>
</div>

<div class=" m-3 px-2 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">All Customers</h5>
   </div>
 
   <div class="flow-root">
        <div class="flex justify-between">
            <span class="text-regal-brown text-lg p-2">PROFILE IMAGE</span>
            <span class="text-regal-brown text-md p-2">FULLNAME</span>
            <span class="text-regal-brown text-md p-2">EMAIL</span>
            <span class="text-regal-brown text-md p-2 ">REVENUE</span>
            <span class="text-regal-brown text-md p-2 mr-10">COUNTRY</span>
        </div> 
        <ul role="list" class="  divide-y divide-gray-200 dark:divide-gray-700">
            <x-admin.CustumersCard  fullname="Neil Sims" email="email@windster.com" revenue="320" country="Algerie"/>
            <hr>
            <hr>
            <x-admin.CustumersCard  fullname="Bonnie Green" email="email@windster.com" revenue="3467" country="Algerie"/>
            <hr>
            <x-admin.CustumersCard  fullname="Michael Gough" email="email@windster.com" revenue="67" country="Tunisie"/>
            <hr>
            <x-admin.CustumersCard  fullname="Lana Byrd" email="email@windster.com" revenue="367" country="Algerie"/>
            <hr>
            <x-admin.CustumersCard  fullname="Thomes Lean" email="email@windster.com" revenue="2367" country="Algerie"/>
            <hr>
            <x-admin.CustumersCard  fullname="Toghil Ibanez" email="email@powerNow.com" revenue="2407" country="Caneda"/>
        </ul>
    </div>
</div>

@endsection