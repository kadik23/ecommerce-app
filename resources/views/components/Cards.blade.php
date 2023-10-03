<div class="m-3 p-5 inline-block text-center bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center justify-center">
        <span class="material-symbols-outlined text-3xl mr-2" style="
        color: {{ $color ?? 'black' }};
        font-variation-settings:
          'FILL' 1,
          'wght' 400,
          'GRAD' 0,
          'opsz' 24 ">
      
        {{$iconCard}}
        </span>
        <h1 class="text-xl opacity-80 font-bold">{{$orderStat}}</h1>
    </div>
  

    <h2  class="font-bold customerCounter text-2xl mt-3" data-target="{{$nbr}}">0</h2>

</div>