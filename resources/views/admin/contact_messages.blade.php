@extends('layouts.dashboard')

@section('content1')
<x-admin.titleCard :title="$contactTitle" />

@php
    $filters = [
        [
            'url' => route('dashboard.contactMessages'),
            'label' => t('admin.contact_messages.filter_all'),
            'count' => $totalCount,
            'active' => !request()->filled('status'),
            'activeClass' => 'bg-regal-brown text-white',
        ],
        [
            'url' => route('dashboard.contactMessages', ['status' => 'unresolved']),
            'label' => t('admin.contact_messages.filter_unresolved'),
            'count' => $unresolvedCount,
            'active' => request()->query('status') === 'unresolved',
            'activeClass' => 'bg-amber-600 text-white',
        ],
        [
            'url' => route('dashboard.contactMessages', ['status' => 'resolved']),
            'label' => t('admin.contact_messages.filter_resolved'),
            'count' => $resolvedCount,
            'active' => request()->query('status') === 'resolved',
            'activeClass' => 'bg-green-600 text-white',
        ],
    ];
@endphp

<div class="flex flex-wrap justify-between items-center my-6 mx-3">
    <!-- Stat summary cards -->
    <div class="flex flex-wrap gap-2">
        <x-Cards iconCard="mail" :nbr="$totalCount" orderStat="total_messages" color="#b17b4f" />
        <x-Cards iconCard="mark_as_unread" :nbr="$unresolvedCount" orderStat="unresolved" color="orange" />
        <x-Cards iconCard="task_alt" :nbr="$resolvedCount" orderStat="resolved" color="green" />
    </div>

    <!-- Filter Buttons -->
    <div class="flex items-center space-x-2 rtl:space-x-reverse my-3">
        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 me-2">{{ t('admin.contact_messages.filter_by') }}</span>
        @foreach($filters as $filter)
            <a href="{{ $filter['url'] }}" 
               class="px-3 py-1.5 text-xs font-medium rounded-md transition-colors {{ $filter['active'] ? $filter['activeClass'] : 'bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}">
                {{ $filter['label'] }} ({{ $filter['count'] }})
            </a>
        @endforeach
    </div>
</div>

<!-- Table Card -->
<div class="m-3 px-4 py-4 bg-white border border-gray-200 rounded-lg overflow-x-auto shadow dark:bg-gray-800 dark:border-gray-700">
    <table class="w-full text-sm text-start text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-regal-brown uppercase bg-gray-50 dark:bg-gray-700 dark:text-regal-brown border-b border-gray-200 dark:border-gray-700">
            <tr>
                <th scope="col" class="px-4 py-3 text-start">#ID</th>
                <th scope="col" class="px-4 py-3 text-start">{{ t('admin.contact_messages.table.name') }}</th>
                <th scope="col" class="px-4 py-3 text-start">{{ t('admin.contact_messages.table.contact') }}</th>
                <th scope="col" class="px-4 py-3 text-start">{{ t('admin.contact_messages.table.country') }}</th>
                <th scope="col" class="px-4 py-3 text-start">{{ t('admin.contact_messages.table.message') }}</th>
                <th scope="col" class="px-4 py-3 text-start">{{ t('admin.contact_messages.table.date') }}</th>
                <th scope="col" class="px-4 py-3 text-center">{{ t('admin.contact_messages.table.status') }}</th>
                <th scope="col" class="px-4 py-3 text-center">{{ t('admin.contact_messages.table.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $msg)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                    <td class="px-4 py-4 font-bold text-gray-900 dark:text-white">
                        #{{ $msg->id }}
                    </td>
                    <td class="px-4 py-4 font-semibold text-gray-900 dark:text-white whitespace-nowrap">
                        {{ $msg->first_name }} {{ $msg->last_name }}
                    </td>
                    <td class="px-4 py-4 text-xs">
                        <div class="font-medium text-gray-900 dark:text-white">{{ $msg->email }}</div>
                        @if($msg->phone_number)
                            <div class="text-gray-500 dark:text-gray-400">{{ $msg->phone_number }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-4 text-xs font-medium text-gray-700 dark:text-gray-300">
                        {{ $msg->country ?: 'N/A' }}
                    </td>
                    <td class="px-4 py-4 text-xs text-gray-700 dark:text-gray-300 max-w-xs break-words">
                        {{ $msg->message }}
                    </td>
                    <td class="px-4 py-4 text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">
                        {{ $msg->created_at->format('Y-m-d H:i') }}
                    </td>
                    <td class="px-4 py-4 text-center whitespace-nowrap">
                        @if($msg->status === 'resolved')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300">
                                <span class="w-1.5 h-1.5 me-1.5 bg-green-500 rounded-full"></span>
                                {{ t('admin.contact_messages.status_resolved') }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300">
                                <span class="w-1.5 h-1.5 me-1.5 bg-amber-500 rounded-full"></span>
                                {{ t('admin.contact_messages.status_unresolved') }}
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-4 text-center whitespace-nowrap">
                        @if($msg->status === 'resolved')
                            <button type="button" onclick="document.getElementById('toggle_status_modal_{{ $msg->id }}').showModal()" class="px-3 py-1 text-xs font-medium text-amber-700 bg-amber-100 rounded-md hover:bg-amber-200 dark:bg-amber-900/30 dark:text-amber-300 dark:hover:bg-amber-900/60 transition-colors">
                                {{ t('admin.contact_messages.mark_unresolved') }}
                            </button>
                            <x-popconfirm 
                                :id="'toggle_status_modal_' . $msg->id"
                                :title="t('admin.contact_messages.mark_unresolved')"
                                :message="t('admin.contact_messages.confirm_mark_unresolved')"
                                :action="route('admin.contactMessages.toggleStatus', $msg->id)"
                                method="POST"
                                :confirmText="t('admin.contact_messages.mark_unresolved')"
                                :cancelText="t('admin.sliders.cancel')"
                                confirmClass="bg-amber-600 hover:bg-amber-700 text-white"
                                icon="help"
                            />
                        @else
                            <button type="button" onclick="document.getElementById('toggle_status_modal_{{ $msg->id }}').showModal()" class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-md hover:bg-green-200 dark:bg-green-900/30 dark:text-green-300 dark:hover:bg-green-900/60 transition-colors">
                                {{ t('admin.contact_messages.mark_resolved') }}
                            </button>
                            <x-popconfirm 
                                :id="'toggle_status_modal_' . $msg->id"
                                :title="t('admin.contact_messages.mark_resolved')"
                                :message="t('admin.contact_messages.confirm_mark_resolved')"
                                :action="route('admin.contactMessages.toggleStatus', $msg->id)"
                                method="POST"
                                :confirmText="t('admin.contact_messages.mark_resolved')"
                                :cancelText="t('admin.sliders.cancel')"
                                confirmClass="bg-green-600 hover:bg-green-700 text-white"
                                icon="task_alt"
                            />
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-8 text-gray-500 dark:text-gray-400">
                        {{ t('admin.contact_messages.no_messages') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<x-Pagination :paginator="$messages" />
@endsection
