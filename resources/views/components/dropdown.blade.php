<div class="dropdown" style="background-color: transparent">
    <label tabindex="0" class="btn hover:text-regal-brown py-0 font-normal m-1" style="background-color: transparent; border:none;" >
        {{$label}}
        <span class="material-symbols-outlined">
        arrow_drop_down
        </span>
    </label>
    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
        @forEach($items AS $item)
      <li><a>{{$item}}</a></li>
      @endforeach
    </ul>
</div>