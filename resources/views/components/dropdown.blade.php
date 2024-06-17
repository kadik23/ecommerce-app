<div class="dropdown" style="background-color: transparent">
    <label tabindex="0" class="flex flex-nowrap justify-center btn text-xs lg:text-sm  hover:text-regal-brown py-0 font-normal m-1" style="background-color: transparent; border:none;">
        <span class="text-nowrap">{{$label}}</span> 
        <span class="material-symbols-outlined">arrow_drop_down</span>
    </label>
    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
        @for ($i = 0; $i < count($items); $i++)
        @php
            $item = $items[$i];
            $link = $links[$i];
        @endphp
            @if($link=='logout')
            <li>
                <a href="{{ route($link) }}" onclick="submitLogoutForm()">{{$item}}</a>
            </li>
            @else
            <li>
                <a href="{{ route($link) }}" >{{$item}}</a>
            </li>
            @endif
        @endfor
    </ul>
    @if(in_array("Logout", $items))
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    @endif
</div>
<script>
function submitLogoutForm(){
    event.preventDefault();
    document.getElementById('logout-form').submit();
}
</script>
