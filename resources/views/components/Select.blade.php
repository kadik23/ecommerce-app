<form id="filterForm" action="" method="GET">
    <select id="filter" name="filter" class="  text-left border text-lg border-gray-200 text-gray-900 shadow rounded-lg hover:border-regal-brown transition-all duration-300  focus:ring-regal-brown focus:border-regal-brown block w-72   px-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-regal-brown dark:focus:border-regal-brown">
        <option selected>{{$option}}</option>
        <option value="Available"> Available</option>
        <option value="LowToHigh">{{$name}}: Low to High</option>
        <option value="HighToLow">{{$name}}: High to Low</option>
    </select>
</form>