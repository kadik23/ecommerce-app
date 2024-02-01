@extends('layouts.accounts')
@section('content')
<div class="container ">

<div class="font-bold mt-10 opacity-80 px-10 text-3xl">My order :</div>
<div class="flex px-10 mt-5 ml-5">
    <x-users.tags tagname="Processing" />
    <x-users.tags tagname="Shiped" />
    <x-users.tags tagname="Delivered" />
</div>
<div class="flex flex-wrap px-10">
    @foreach ($Orders as $Order)        
        <x-users.processCards :data="$Order"/>
    @endforeach
</div>
</div>

@endsection