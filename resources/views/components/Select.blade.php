@props([
    'action' => null,
    'option' => '',
    'name' => ''
])

@php
    $finalAction = $action ?? route('product.filter');
@endphp

<form id="filterForm" action="{{ $finalAction }}" method="GET">
    <select id="filter" name="filter" class="text-left border text-lg border-gray-200 text-gray-900 shadow rounded-lg hover:border-regal-brown transition-all duration-300 focus:ring-regal-brown focus:border-regal-brown block w-72 px-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-regal-brown dark:focus:border-regal-brown">
        <option value="" {{ request('filter') == '' ? 'selected' : '' }}>{{ $option }}</option>
        <option value="Available" {{ request('filter') == 'Available' ? 'selected' : '' }}>{{ t('admin.filters.available') }}</option>
        <option value="LowToHigh" {{ request('filter') == 'LowToHigh' ? 'selected' : '' }}>{{ $name }}: {{ t('admin.filters.low_to_high') }}</option>
        <option value="HighToLow" {{ request('filter') == 'HighToLow' ? 'selected' : '' }}>{{ $name }}: {{ t('admin.filters.high_to_low') }}</option>
    </select>
</form>