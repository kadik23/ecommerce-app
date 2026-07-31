@extends('layouts.dashboard')

@section('content1')
<x-admin.titleCard :title="$sliderTitle" />

<div class="m-3 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 my-6">
    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">{{ t('admin.sliders.upload_new_slider') }}</h3>
    
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-700 dark:text-green-400" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
        @csrf
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="slider_image">
                {{ t('admin.sliders.choose_image') }} <span class="text-red-500">*</span>
            </label>
            <input name="image" required id="slider_image" type="file" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="slider_title">
                {{ t('admin.sliders.title_optional') }}
            </label>
            <input name="title" id="slider_title" type="text" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-regal-brown focus:border-regal-brown block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
        </div>

        <div>
            <button type="submit" class="w-full text-white bg-regal-brown hover:bg-amber-700 focus:ring-4 focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors">
                {{ t('admin.sliders.upload_button') }}
            </button>
        </div>
    </form>
</div>

<!-- Active Sliders Grid -->
<div class="m-3 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <h3 class="text-lg font-bold mb-6 text-gray-900 dark:text-white">{{ t('admin.sliders.active_sliders') }} ({{ count($sliders) }})</h3>
    
    @if(count($sliders) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($sliders as $slide)
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden bg-gray-50 dark:bg-gray-900 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="relative w-full h-48 bg-gray-200 dark:bg-gray-800 overflow-hidden">
                            <img src="{{ asset('assets/images/slider/' . $slide->image) }}" alt="{{ $slide->title ?: t('admin.sliders.untitled_slide') }}" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-900 dark:text-white text-md">{{ $slide->title ?: t('admin.sliders.untitled_slide') }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ t('admin.sliders.uploaded_at') }}: {{ $slide->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <!-- Trigger Button -->
                        <button type="button" onclick="document.getElementById('delete_modal_{{ $slide->id }}').showModal()" class="w-full text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-xs px-3 py-2 text-center transition-colors">
                            {{ t('admin.sliders.delete') }}
                        </button>

                        <!-- Reusable Popconfirm Component -->
                        <x-popconfirm 
                            :id="'delete_modal_' . $slide->id"
                            :title="t('admin.sliders.delete')"
                            :message="t('admin.sliders.confirm_delete')"
                            :action="route('admin.sliders.delete', $slide->id)"
                            method="DELETE"
                            :confirmText="t('admin.sliders.delete')"
                            :cancelText="t('admin.sliders.cancel')"
                        />
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-10 text-gray-500 dark:text-gray-400">
            <span class="material-symbols-outlined text-5xl mb-2 text-gray-300 dark:text-gray-600">view_carousel</span>
            <p class="text-sm">{{ t('admin.sliders.no_custom_sliders') }}</p>
        </div>
    @endif
</div>
@endsection
