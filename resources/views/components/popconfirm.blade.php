@props([
    'id',
    'title' => null,
    'message' => 'Are you sure you want to proceed?',
    'action' => '#',
    'method' => 'POST',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'confirmClass' => 'bg-red-600 hover:bg-red-700 text-white',
    'icon' => 'warning'
])

<dialog id="{{ $id }}" class="modal">
    <div class="modal-box bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
        @if($title)
            <h3 class="font-bold text-lg text-red-600 flex items-center gap-2">
                <span class="material-symbols-outlined">{{ $icon }}</span>
                {{ $title }}
            </h3>
        @endif
        
        <p class="py-4 text-sm text-gray-600 dark:text-gray-300">
            {{ $message }}
        </p>

        <div class="modal-action flex justify-end gap-3">
            <form method="dialog">
                <button type="submit" class="px-4 py-2 text-xs font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
                    {{ $cancelText }}
                </button>
            </form>
            <form action="{{ $action }}" method="POST">
                @csrf
                @if(strtoupper($method) !== 'POST')
                    @method($method)
                @endif
                {{ $slot }}
                <button type="submit" class="px-4 py-2 text-xs font-medium rounded-lg transition-colors {{ $confirmClass }}">
                    {{ $confirmText }}
                </button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
