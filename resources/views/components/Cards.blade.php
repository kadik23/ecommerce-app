<div class="m-3 p-6 flex-grow flex-shrink-0 lg:flex-grow-0 lg:flex-shrink lg:p-5 inline-block text-center bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
  <div class="flex items-center justify-center">
      <span class="material-symbols-outlined text-xl lg:text-3xl mr-2" style="
        color: {{ $color ?? 'black' }};
        font-variation-settings:
          'FILL' 1,
          'wght' 400,
          'GRAD' 0,
          'opsz' 24 "
      >
      {{$iconCard}}
      </span>
      <h1 class="text-xl lg:text-3xl opacity-80 font-bold capitalize">{{$orderStat}}</h1>
  </div>
  <h2  class="font-bold customerCounter text-2xl mt-3" data-target="{{$nbr}}">0</h2>
</div>